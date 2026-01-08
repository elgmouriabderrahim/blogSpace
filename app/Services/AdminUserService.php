<?php
namespace App\Services;
use App\Repository\AdminUserRepository;
class AdminUserService{
    public static function getAllUsers(): array
    {
        return AdminUserRepository::findAll();
    }

    public static function toggleBan(int $userId): void
    {
        AdminUserRepository::toggleBan($userId);
    }
}
