<?php
namespace App\Repository;

use App\Core\Database;
use PDO;

class AdminUserRepository
{
    public static function findAll(): array
    {
        $stmt = Database::getInstance()
            ->getConnection()
            ->query("SELECT * FROM users");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function toggleBan(int $id): void
    {
        $sql = "UPDATE users 
                SET is_banned = NOT is_banned 
                WHERE id = :id";

        $stmt = Database::getInstance()
            ->getConnection()
            ->prepare($sql);

        $stmt->execute(['id' => $id]);
    }
}
