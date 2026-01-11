<?php

namespace App\Controllers;
use App\Core\Controller;

use App\Services\AuthorDashboardService;

use App\Middlewears\Auth;
Auth::onlyAuthor();

class AuthorDashboardController extends Controller
{
    public function index(){
        $articles = AuthorDashboardService::getMyArticles($_SESSION['user_id']);

        $this->view('author/dashboard', ['title' => 'Blog Space - dashboard', 'articles' => $articles]);
    }
}