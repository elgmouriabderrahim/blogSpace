<?php
namespace App\Services;

use App\Repository\AdminCategoryRepository;
class AdminCategoryService{
    public static function getAll(): array
    {
        return AdminCategoryRepository::findAll();
    }

    public static function isCategoryExists(string $name): bool
    {
        return AdminCategoryRepository::isCategoryExists($name);
    }
    public static function create(string $name): void
    {
        if (trim($name) === '') return;
        AdminCategoryRepository::create($name);
    }

    public static function delete(int $id): void
    {
        AdminCategoryRepository::delete($id);
    }
}
