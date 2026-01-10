<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\ReaderArticleService;

class ReaderArticleController extends Controller {

    public function show() {
        $articleId = $_POST['article_id'] ?? null;
        if (!$articleId) {
            header("HTTP/1.0 400 Bad Request");
            echo "Article ID is required.";
            exit;
        }

        $article = ReaderArticleService::getArticle($articleId);
        if (!$article) {
            header("HTTP/1.0 404 Not Found");
            echo "Article not found.";
            exit;
        }

        $comments = ReaderArticleService::getComments($articleId);
        $errors = [];
        $old = [];

        $this->view('reader/articles/show', compact('article','comments','errors','old'));
    }

    public function comment() {
        $readerId = $_SESSION['user_id'];
        $articleId = $_POST['article_id'];
        $content = $_POST['content'] ?? '';

        $errors = ReaderArticleService::addComment($articleId, $readerId, $content);
        $old = ['content' => $content];

        $article = ReaderArticleService::getArticle($articleId);
        $comments = ReaderArticleService::getComments($articleId);

        $this->view('reader/articles/show', compact('article','comments','errors','old'));
    }

    public function deleteComment() {
        $readerId = $_SESSION['user_id'];
        $commentId = $_POST['comment_id'];
        ReaderArticleService::deleteComment($commentId, $readerId);

        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function likeArticle() {
        $readerId = $_SESSION['user_id'];
        $articleId = $_POST['article_id'];
        ReaderArticleService::likeArticle($articleId, $readerId);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function unlikeArticle() {
        $readerId = $_SESSION['user_id'];
        $articleId = $_POST['article_id'];
        ReaderArticleService::unlikeArticle($articleId, $readerId);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function likeComment() {
        $readerId = $_SESSION['user_id'];
        $commentId = $_POST['comment_id'];
        ReaderArticleService::likeComment($commentId, $readerId);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }

    public function unlikeComment() {
        $readerId = $_SESSION['user_id'];
        $commentId = $_POST['comment_id'];
        ReaderArticleService::unlikeComment($commentId, $readerId);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
