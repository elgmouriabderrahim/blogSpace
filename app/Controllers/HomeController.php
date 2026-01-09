<?php

namespace App\Controllers;
use App\Core\Controller;

class HomeController extends Controller
{
    public function index(){
    $articles = [
    [
        'id'       => 1,
        'title'    => 'First Article',
        'excerpt'  => 'This is a short preview of the article...',
        'author'   => 'John Doe',
        'date'     => 'March 10, 2026',
        'likes'    => 12,
        'comments' => 4
    ],
    [
        'id'       => 2,
        'title'    => 'Second Article',
        'excerpt'  => 'Another article preview of a very interesting post...',
        'author'   => 'Jane Smith',
        'date'     => 'March 8, 2026',
        'likes'    => 3,
        'comments' => 1
    ]
];

    $userRole = $_SESSION['user']['role'] ?? 'visitor';

        $this->view('home/index', ['title' => 'Blog Space','userRole' => $userRole ,'articles' => $articles]);
    }
}