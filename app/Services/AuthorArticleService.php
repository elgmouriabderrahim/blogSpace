<?php
namespace App\Services;

use App\Models\Article;
use App\Repository\AuthorArticleRepository;
use App\Helpers\Helpers;

class AuthorArticleService {

    public static function create(int $authorId, string $title, string $content, string $status): void {
        $article = new Article([
            'author_id' => $authorId,
            'title' => $title,
            'content' => $content,
            'created_at' => date('Y-m-d H:i:s'),
            'status' => $status,
            'author_name' => $_SESSION['firstName'] . ' ' . $_SESSION['lastName'],
            'likes_count' => 0,
            'comments_count' => 0

        ]);
        AuthorArticleRepository::create($article);
    }

    public static function getMyArticles(int $authorId): array {
        return AuthorArticleRepository::getByAuthor($authorId);
    }

    public static function getArticle(int $id, int $authorId): ?Article {
        return AuthorArticleRepository::findByIdAndAuthor($id, $authorId);
    }

    public static function update(Article $article, string $title, string $content, string $status): void {
        $article->setTitle($title);
        $article->setContent($content);
        $article->setStatus($status);
        $article->setUpdatedAt(date('Y-m-d H:i:s'));
        AuthorArticleRepository::update($article);
    }

    public static function delete(int $id, int $authorId): void {
        AuthorArticleRepository::delete($id, $authorId);
    }

    public static function validateArticle(string $title, string $content, string $status): array {
        return Helpers::validateArticle($title, $content, $status);
    }
}
