<?php
namespace App\Repository;

use App\Helpers\Helpers;

use App\Core\Database;
use PDO;

class AdminUserRepository
{
    public static function getAllUsers(): array{
        $stmt = Database::getInstance()
            ->getConnection()
            ->query("SELECT * FROM users");

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return array_map(fn($user) => Helpers::createUser($user),$users);
    }

    public static function findById(int $id) {
        $stmt = Database::getInstance()
            ->getConnection()
            ->prepare("SELECT * FROM users WHERE id = :id");

        $stmt->execute(['id' => $id]);
        return Helpers::createUser($stmt->fetch(PDO::FETCH_ASSOC) ?: null);
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