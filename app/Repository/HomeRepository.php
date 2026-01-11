<?php
namespace App\Repository;

use App\Core\Database;
use App\Models\Article;
use PDO;

class HomeRepository {

   public static function getAllArticles(): array {
        $db = Database::getInstance()->getConnection();
        $readerId = $_SESSION['user_id'] ?? 0;

        $stmt = $db->prepare(
            "SELECT a.*,
            CONCAT(u.firstName, ' ', u.lastName) AS author_name,
            (SELECT COUNT(*) FROM comments c WHERE c.article_id = a.id) AS comments_count,
            (SELECT COUNT(*) FROM likes l WHERE l.article_id = a.id) AS likes_count,
            CASE WHEN EXISTS (
                SELECT 1 FROM likes l2 
                WHERE l2.article_id = a.id AND l2.reader_id = :reader_id
            ) THEN 1 ELSE 0 END AS liked_by_reader
            FROM articles a
            JOIN users u ON a.author_id = u.id
            WHERE a.status = 'published'
            ORDER BY a.created_at DESC"
        );

        $stmt->execute(['reader_id' => $readerId]);
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(function($article) {
            $article['liked_by_reader'] = (bool)($article['liked_by_reader'] ?? 0);
            return new Article($article);
        }, $articles);
    }
}
