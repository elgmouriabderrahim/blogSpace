<?php
namespace App\Repository;

use App\Core\Database;
use App\Models\Article;
use PDO;

class AuthorDashboardRepository {

    public static function getMyArticles(int $author_id): array
    {
        $stmt = Database::getInstance()
            ->getConnection()
            ->prepare(
                "SELECT * 
                 FROM articles 
                 WHERE author_id = :author_id 
                 ORDER BY created_at DESC"
            );

        $stmt->execute(['author_id' => $author_id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($row) => new Article(array_merge($row, ['author_name' => $_SESSION['user_firstName'] . ' ' . $_SESSION['user_lastName']])), $rows);
    }

    public static function delete(int $id, int $author_id): void
    {
        $stmt = Database::getInstance()
            ->getConnection()
            ->prepare(
                "DELETE FROM articles 
                 WHERE id = :id AND author_id = :author_id"
            );

        $stmt->execute([
            'id' => $id,
            'author_id' => $author_id
        ]);
    }

    public static function findByIdAndAuthor(int $id, int $author_id): ?Article
    {
        $stmt = Database::getInstance()
            ->getConnection()
            ->prepare(
                "SELECT * FROM articles 
                 WHERE id = :id AND author_id = :author_id 
                 LIMIT 1"
            );

        $stmt->execute([
            'id' => $id,
            'author_id' => $author_id
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Article($row) : null;
    }
}
