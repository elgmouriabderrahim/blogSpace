<?php namespace App\Controllers;
use App\Core\Controller;
use App\Services\AuthorArticleService;
use App\Services\AdminCategoryService;

use App\Middlewears\Auth;
Auth::onlyAuthor();

class AuthorArticlesController extends Controller
{
    public function create()
    {
        $errors = [];
        $old = [];
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $title = $_POST["title"] ?? "";
            $content = $_POST["content"] ?? "";
            $status = $_POST["status"] ?? "Draft";
            $categories = $_POST["categories"] ?? [];

            $old = compact("title", "content", "status", "categories");
            $errors = AuthorArticleService::validateArticle($title ,$content ,$status, $categories);
            if (empty($errors)) {
                AuthorArticleService::create($_SESSION["user_id"] ,$title ,$content ,$status, $categories);
                header("Location: /author/dashboard");
                exit();
            }
        }
        $categories = AdminCategoryService::getAllCategories();

        $this->view("author/articles/create", compact("errors", "old", "categories"));
    }

    public function editform()
{
    $articleId = (int)($_POST['article_id'] ?? 0);
    $authorId = $_SESSION['user_id'];

    if (!$articleId) {
        http_response_code(404);
        $this->view('404');
        exit;
    }

    $article = AuthorArticleService::getArticle($articleId, $authorId);
    if (!$article) {
        http_response_code(404);
        $this->view('404');
        exit;
    }

    $categories = AdminCategoryService::getAllCategories();
    $articleCategoryIds = AuthorArticleService::getArticleCategoryIds($articleId);

    $errors = [];
    $old = [
        'id' => $article->getId(),
        'title' => $article->getTitle(),
        'content' => $article->getContent(),
        'status' => $article->getStatus(),
        'categories' => $articleCategoryIds
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';
        $status = $_POST['status'] ?? 'draft';
        $selectedCategories = $_POST['categories'] ?? [];

        $errors = AuthorArticleService::validateArticle($title, $content, $status, $selectedCategories);

        $old = [
            'id' => $articleId,
            'title' => $title,
            'content' => $content,
            'status' => $status,
            'categories' => $selectedCategories
        ];

        if (empty($errors)) {
            AuthorArticleService::update($article, $title, $content, $status, $selectedCategories);
            header("Location: /author/dashboard");
            exit;
        }
    }

    // Render view
    $this->view("author/articles/edit", compact('old', 'errors', 'categories'));
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
