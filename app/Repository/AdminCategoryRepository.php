<?php
namespace App\Repository;

use App\Core\Database;
use PDO;

class AdminCategoryRepository
{
    public static function findAll(): array
    {
        return Database::getInstance()
            ->getConnection()
            ->query("SELECT * FROM categories ORDER BY name")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function isCategoryExists(string $name): bool
    {
        $stmt = Database::getInstance()
        ->getConnection()
        ->prepare("SELECT 1 FROM categories WHERE name = :name LIMIT 1");

        $stmt->execute(['name' => $name]);

        return (bool) $stmt->fetchColumn();
    }

    public static function create(string $name): void
    {
        $stmt = Database::getInstance()
            ->getConnection()
            ->prepare("INSERT INTO categories (name) VALUES (:name)");

        $stmt->execute(['name' => $name]);
    }

    public static function delete(int $id): void
    {
        $stmt = Database::getInstance()
            ->getConnection()
            ->prepare("DELETE FROM categories WHERE id = :id");

        $stmt->execute(['id' => $id]);
    }
}
