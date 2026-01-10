<?php namespace App\Controllers;
use App\Core\Controller;
use App\Services\AuthorArticleService;
class AuthorArticlesController extends Controller
{
    public function dashboard()
    {
        $articles = AuthorArticleService::getMyArticles($_SESSION["user_id"]);
        $this->view("author/articles/dashboard", [
            "title" => "My Articles",
            "articles" => $articles,
        ]);
    }
    public function create()
    {
        $errors = [];
        $old = [];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $title = $_POST["title"] ?? "";
            $content = $_POST["content"] ?? "";
            $status = $_POST["status"] ?? "Draft";
            $old = compact("title", "content", "status");
            $errors = AuthorArticleService::validateArticle(
                $title,
                $content,
                $status
            );
            if (empty($errors)) {
                AuthorArticleService::create(
                    $_SESSION["user_id"],
                    $title,
                    $content,
                    $status
                );
                header("Location: /author/dashboard");
                exit();
            }
        }
        $this->view("author/articles/create", compact("errors", "old"));
    }
    public function edit()
    {
        $this->view("author/articles/edit");
    }
    public function editform()
    {
        $articleId = (int)$_POST['article_id'];
        $authorId = $_SESSION["user_id"];

        $article = AuthorArticleService::getArticle($articleId, $authorId);
        
        $errors = [];
        $old = [
            'id' => $article->getId(),
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'status' => $article->getStatus(),
        ];

        
        if(isset($_POST["title"]) && isset($_POST["content"]) && isset($_POST["status"])){
            $title = $_POST["title"] ?? '';
            $content = $_POST["content"] ?? '';
            $status = $_POST["status"] ?? '';
            $errors = AuthorArticleService::validateArticle($title ,$content ,$status);


            $old = [
                'id' => $articleId,
                'title' => $title,
                'content' => $content,
                'status' => $status,
            ];
            if (empty($errors)) {
                AuthorArticleService::update($article , $title, $content, $status);
                header("Location: /author/dashboard");
                exit();
            }
        }
       
        $this->view("author/articles/edit", ['old' => $old, 'errors' => $errors]);
    }
    public function viewArticle()
    {
        $authorId = $_SESSION["user_id"];
        $id = $_POST["article_id"] ?? null;
        if (!$id) {
            header("HTTP/1.0 400 Bad Request");
            echo "Article ID is required.";
            exit();
        }
        $article = \App\Repository\AuthorArticleRepository::findByIdAndAuthor(
            $id,
            $authorId
        );
        if (!$article) {
            header("HTTP/1.0 404 Not Found");
            echo "Article not found or you don’t have permission.";
            exit();
        }
        $this->view("author/articles/view", [
            "title" => $article->getTitle(),
            "article" => $article,
        ]);
    }
    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = (int) ($_POST["article_id"] ?? 0);
            AuthorArticleService::delete($id, $_SESSION["user_id"]);
        }
        header("Location: /author/dashboard");
        exit();
    }
}
