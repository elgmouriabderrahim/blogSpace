<?php
namespace App\Services;
use App\Repository\AdminUserRepository;
class AdminUserService{
    public static function getAllUsers(): array
    {
        return AdminUserRepository::findAll();
    }

    public static function banUser(int $userId): void
    {
        $user = AdminUserRepository::findById($userId);

        if (!$user || $user['role'] !== 'Reader')
            return;

        AdminUserRepository::banUser($userId);
    }
    public static function unbanUser(int $userId): void
    {
        $user = AdminUserRepository::findById($userId);

        if (!$user || $user['role'] !== 'Reader')
            return;
        
        AdminUserRepository::unbanUser($userId);
    }
}
