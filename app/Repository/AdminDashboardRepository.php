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
}

