<?php
namespace App\Repository;

use App\Core\Database;
use App\Models\Article;
use PDO;

class AuthorArticleRepository {

    public static function create(Article $article): void {
        $stmt = Database::getInstance()
            ->getConnection()
            ->prepare(
                "INSERT INTO articles (author_id, title, content, status) 
                 VALUES (:author_id, :title, :content, :status)"
            );

        $stmt->execute([
            'author_id' => $article->getAuthorId(),
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'status' => $article->getStatus()
        ]);
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

    public static function update(Article $article): void {
        $stmt = Database::getInstance()
            ->getConnection()
            ->prepare(
                "UPDATE articles SET title = :title, content = :content, status = :status, updated_at = NOW()
                 WHERE id = :id AND author_id = :author_id"
            );

        $stmt->execute([
            'id' =>  $article->getId(),
            'author_id' => $article->getAuthorId(),
            'title' => $article->getTitle(),
            'content' => $article->getContent(),
            'status' => $article->getStatus()
        ]);
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
