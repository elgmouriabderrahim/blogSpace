<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\ReaderArticleService;

class ReaderArticleController extends Controller {

    public function show() {
        $articleId = $_SESSION['article_id'] ?? $_POST['article_id'] ?? null;
        $errors = $_SESSION['errors'] ?? [];
        $old = $_SESSION['old'] ?? [];
        
        unset($_SESSION['errors']);
        unset($_SESSION['article_id']);
        unset($_SESSION['old']);


        if (!$articleId) {
            http_response_code(404);
            $this->view('404', ['title' => 'Article ID is required']);
            exit;
        }

        $article = ReaderArticleService::getArticle($articleId);
        if (!$article) {
            http_response_code(404);
            $this->view('404', ['title' => 'Article not found']);
            exit;
        }

        $comments = ReaderArticleService::getComments($articleId);

        $this->view('articles/show', compact('article','comments', 'errors', 'old'));
    }

    public function comment() {
        $readerId = $_SESSION['user_id'];
        $articleId = $_POST['article_id'];
        $content = $_POST['content'] ?? '';

        $_SESSION['errors'] = ReaderArticleService::addComment($articleId, $readerId, $content);
        if($_SESSION['errors'])
            $_SESSION['old'] = ['content' => $content];

        $_SESSION['article_id'] = $articleId;
        header('location: /articles/show');
        exit;
    }

    public function deleteComment() {
        $readerId = $_SESSION['user_id'];
        $commentId = $_POST['comment_id'];
        ReaderArticleService::deleteComment($commentId, $readerId);

        $_SESSION['article_id'] = $_POST['article_id'];
        header("Location: /articles/show");
        exit;
    }

    public function likeArticle() {
        $readerId = $_SESSION['user_id'];
        $articleId = $_POST['article_id'];
        $likedByReader = $_POST['liked_by_reader'];

        if($likedByReader){
            ReaderArticleService::unlikeArticle($articleId, $readerId);
            $_SESSION['article_id'] = $articleId;
            header("Location: " . $_POST['previous']);
            exit;
        }else{
            ReaderArticleService::likeArticle($articleId, $readerId);
    
            $_SESSION['article_id'] = $articleId;
            header("Location: " . $_POST['previous']);
            exit;
        }
        
    }


    public function likeComment() {
        $readerId = $_SESSION['user_id'];
        $commentId = $_POST['comment_id'];
        $likedByReader = $_POST['liked_by_reader'];

        if($likedByReader){
            ReaderArticleService::unlikeComment($commentId, $readerId);

            $_SESSION['article_id'] = $_POST['article_id'];
            header("Location: /articles/show");
            exit;
        }else{
            ReaderArticleService::likeComment($commentId, $readerId);
    
            $_SESSION['article_id'] = $_POST['article_id'];
            header("Location: /articles/show");
            exit;
        }
    }

}
