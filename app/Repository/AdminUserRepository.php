<?php
namespace App\Repository;

use App\Core\Database;
use PDO;

class AdminUserRepository
{
    public static function findAll(): array{
        $stmt = Database::getInstance()
            ->getConnection()
            ->query("SELECT * FROM users");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById(int $id): ?array{
        $stmt = Database::getInstance()
            ->getConnection()
            ->prepare("SELECT * FROM users WHERE id = :id");

        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function banUser(int $id): void{
        $sql = "UPDATE users 
                SET is_banned = '1'
                WHERE id = :id";

        $stmt = Database::getInstance()
            ->getConnection()
            ->prepare($sql);

        $stmt->execute(['id' => $id]);
    }

    public static function unbanUser(int $id): void{
        $sql = "UPDATE users 
                SET is_banned = '0'
                WHERE id = :id";

        $stmt = Database::getInstance()
            ->getConnection()
            ->prepare($sql);

        $stmt->execute(['id' => $id]);
    }
}