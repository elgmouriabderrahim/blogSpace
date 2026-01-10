<?php
namespace App\Services;
use App\Helpers\Helpers;
use App\Repository\AdminCategoryRepository;
class AdminCategoryService{
    public static function getAllCategories(): array
    {
        return AdminCategoryRepository::getAllCategories();
    }

    public static function validateCategory($categoryName)
    {
        return Helpers::validateCategory($categoryName);
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

    public static function delete($id): void
    {
        AdminCategoryRepository::delete($id);
    }
}
