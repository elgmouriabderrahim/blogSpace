<?php
namespace App\Repository;

use App\Core\Database;
use PDO;

class AdminDashboardRepository
{
    public static function countUsers(): int
    {
        return Database::getInstance()
            ->getConnection()
            ->query("SELECT COUNT(*) FROM users")
            ->fetchColumn();
    }

    public static function countBannedUsers(): int
    {
        return Database::getInstance()
            ->getConnection()
            ->query("SELECT COUNT(*) FROM users WHERE is_banned = 1")
            ->fetchColumn();
    }

    public static function countArticles(): int
    {
        return Database::getInstance()
            ->getConnection()
            ->query("SELECT COUNT(*) FROM articles")
            ->fetchColumn();
    }

    public static function countCategories(): int
    {
        return Database::getInstance()
            ->getConnection()
            ->query("SELECT COUNT(*) FROM categories")
            ->fetchColumn();
    }
    public static function getRecentActivities(int $limit = 6): array
    {
        $db = Database::getInstance()->getConnection();

        $sql = "
        (
            SELECT 
                CONCAT('New user registered: ', userName) AS message,
                created_at AS time
            FROM users
        )
        UNION ALL
        (
            SELECT 
                CONCAT('User banned: ', userName) AS message,
                created_at AS time
            FROM users
            WHERE is_banned = '1'
        )
        UNION ALL
        (
            SELECT 
                CONCAT('Article created: ', title) AS message,
                created_at AS time
            FROM articles
        )
        UNION ALL
        (
            SELECT 
                CONCAT('Article published: ', title) AS message,
                updated_at AS time
            FROM articles
            WHERE status = 'published'
        )
        UNION ALL
        (
            SELECT 
                'New comment added' AS message,
                created_at AS time
            FROM comments
        )
        UNION ALL
        (
            SELECT 
                'New like added' AS message,
                created_at AS time
            FROM likes
        )
        ORDER BY time DESC
        LIMIT :limit
        ";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

