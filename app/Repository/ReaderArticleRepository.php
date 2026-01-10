<?php
namespace App\Repository;

use App\Core\Database;
use App\Models\Article;
use App\Models\Comment;
use PDO;

class ReaderArticleRepository {

    public static function findArticleById(int $id): ?Article {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("
            SELECT a.*, CONCAT(u.firstName, ' ', u.lastName) AS author_name,
                (SELECT COUNT(*) FROM likes l WHERE l.article_id = a.id) AS likes_count,
                (SELECT COUNT(*) FROM comments c WHERE c.article_id = a.id) AS comments_count
            FROM articles a
            JOIN users u ON a.author_id = u.id
            WHERE a.id = :id AND a.status = 'published'
            LIMIT 1
        ");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? new Article($row) : null;
    }

    public static function getCommentsByArticle(int $articleId): array {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
            SELECT c.*, CONCAT(u.firstName,' ',u.lastName) AS reader_name,
                (SELECT COUNT(*) FROM likes l WHERE l.comment_id = c.id) AS likes_count
            FROM comments c
            JOIN users u ON c.reader_id = u.id
            WHERE c.article_id = :article_id
            ORDER BY c.created_at DESC
        ");
        $stmt->execute(['article_id' => $articleId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(fn($row) => new Comment($row), $rows);
    }

    public static function addComment(int $articleId, int $readerId, string $content): void {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO comments (article_id, reader_id, content) VALUES (:article_id, :reader_id, :content)");
        $stmt->execute([
            'article_id' => $articleId,
            'reader_id' => $readerId,
            'content' => $content
        ]);
    }

    public static function deleteComment(int $commentId, int $readerId): void {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM comments WHERE id = :id AND reader_id = :reader_id");
        $stmt->execute([
            'id' => $commentId,
            'reader_id' => $readerId
        ]);
    }

    public static function likeArticle(int $articleId, int $readerId): void {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT IGNORE INTO likes (reader_id, article_id) VALUES (:reader_id, :article_id)");
        $stmt->execute(['reader_id' => $readerId, 'article_id' => $articleId]);
    }

    public static function unlikeArticle(int $articleId, int $readerId): void {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM likes WHERE reader_id = :reader_id AND article_id = :article_id");
        $stmt->execute(['reader_id' => $readerId, 'article_id' => $articleId]);
    }

    public static function likeComment(int $commentId, int $readerId): void {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT IGNORE INTO likes (reader_id, comment_id) VALUES (:reader_id, :comment_id)");
        $stmt->execute(['reader_id' => $readerId, 'comment_id' => $commentId]);
    }

    public static function unlikeComment(int $commentId, int $readerId): void {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM likes WHERE reader_id = :reader_id AND comment_id = :comment_id");
        $stmt->execute(['reader_id' => $readerId, 'comment_id' => $commentId]);
    }
}
