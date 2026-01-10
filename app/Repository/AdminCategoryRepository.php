<?php
namespace App\Repository;
use App\Core\Database;
use PDO;

use App\Models\Category;

class AdminCategoryRepository
{
    public static function getAllCategories(): array
    {
        $categories = Database::getInstance()
            ->getConnection()
            ->query("SELECT * FROM categories ORDER BY name")
            ->fetchAll(PDO::FETCH_ASSOC);
        return array_map(function ($category) {return new Category($category);},$categories);
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
