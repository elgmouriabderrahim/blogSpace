<?php
namespace App\Services;

use App\Repository\AdminDashboardRepository;

class AdminDashboardService{
    public static function getDashboardStats(): array
    {
        return [
            'users'      => AdminDashboardRepository::countUsers(),
            'banned'     => AdminDashboardRepository::countBannedUsers(),
            'articles'      => AdminDashboardRepository::countArticles(),
            'categories' => AdminDashboardRepository::countCategories(),
        ];
    }
}
