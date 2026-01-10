<?php
namespace App\Services;

use App\Repository\AuthorDashboardRepository;

class AuthorDashboardService{

    public static function getMyArticles($id): array{
        return AuthorDashboardRepository::getMyArticles($id);
    }
}
