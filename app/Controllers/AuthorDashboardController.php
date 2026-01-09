<?php

namespace App\Controllers;
use App\Core\Controller;

class AuthorDashboardController extends Controller
{
    public function index(){
        $this->view('author/dashboard', ['title' => 'Blog Space - dashboard']);
    }
}