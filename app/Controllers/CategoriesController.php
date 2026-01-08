<?php

namespace App\Controllers;
use App\Core\Controller;

class CategoriesController extends Controller
{
    public function index(){
        $this->view('Admin/categories', ['title' => 'Blog Space - categories']);
    }
}