<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\HomeService;

class HomeController extends Controller {
    public function index() {
        $articles = HomeService::getAllArticles();
        $userRole = $_SESSION['user_role'] ?? 'Visitor';

        $this->view('home/index', [
            'title' => 'Blog Space',
            'userRole' => $userRole,
            'articles' => $articles
        ]);
    }
}
