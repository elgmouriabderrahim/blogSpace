<?php
namespace App\Repository;

use App\Core\Database;
use App\Models\Article;
use PDO;

class AuthorArticleRepository {

    public static function create(Article $article, array $categories): void
{
    $pdo = Database::getInstance()->getConnection();

    $stmt = $pdo->prepare(
        "INSERT INTO articles (author_id, title, content, status) 
         VALUES (:author_id, :title, :content, :status)"
    );

    $stmt->execute([
        'author_id' => $article->getAuthorId(),
        'title' => $article->getTitle(),
        'content' => $article->getContent(),
        'status' => $article->getStatus()
    ]);

    $articleId = (int) $pdo->lastInsertId();

    $stmt = $pdo->prepare(
        "INSERT INTO article_category (article_id, category_id)
         VALUES (:article_id, :category_id)"
    );

    foreach ($categories as $categoryId) {
        $stmt->execute([
            'article_id' => $articleId,
            'category_id' => (int) $categoryId
        ]);
    }
}


    public static function getByAuthor(int $authorId): array {
        $stmt = Database::getInstance()
            ->getConnection()
            ->prepare("SELECT * FROM articles WHERE author_id = :author_id ORDER BY created_at DESC");
        $stmt->execute(['author_id' => $authorId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new Article($row), $rows);
    }

    public static function findByIdAndAuthor(int $id, int $authorId): ?Article {
        $stmt = Database::getInstance()
            ->getConnection()
            ->prepare("SELECT * FROM articles WHERE id = :id AND author_id = :author_id LIMIT 1");
        $stmt->execute([
            'id' => $id,
            'author_id' => $authorId
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row)
            return new Article([...$row,'author_name' => $_SESSION['user_firstName'] . ' ' .  $_SESSION['user_lastName']]);
        else
            return null;
    }

    public static function update(Article $article, array $selectedCategories): void {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare(
            "UPDATE articles 
            SET title = :title, content = :content, status = :status, updated_at = NOW()
            WHERE id = :id AND author_id = :author_id"
        );
        $stmt->execute([
            'id' => $article->getId(),
            'author_id' => $article->getAuthorId(),
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'status' => $article->getStatus()
        ]);

        $stmt = $db->prepare("DELETE FROM article_category WHERE article_id = :article_id");
        $stmt->execute(['article_id' => $article->getId()]);

        $stmt = $db->prepare(
            "INSERT INTO article_category (article_id, category_id) VALUES (:article_id, :category_id)"
        );
        foreach ($selectedCategories as $categoryId) {
            $stmt->execute([
                'article_id' => $article->getId(),
                'category_id' => (int)$categoryId
            ]);
        }
    }


    public static function getArticleCategoryIds(int $articleId): array
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare(
            "SELECT category_id
            FROM article_category
            WHERE article_id = :article_id"
        );

        $stmt->execute([
            'article_id' => $articleId
        ]);

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }


    public static function delete(int $id, int $authorId): void {
        $stmt = Database::getInstance()
            ->getConnection()
            ->prepare("DELETE FROM articles WHERE id = :id AND author_id = :author_id");
        $stmt->execute([
            'id' => $id,
            'author_id' => $authorId
        ]);
    }
}
