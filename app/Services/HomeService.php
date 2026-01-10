<?php
namespace App\Services;

use App\Repository\HomeRepository;

class HomeService {
    public static function getAllArticles(): array {
        return HomeRepository::getAllArticles();
    }
}
