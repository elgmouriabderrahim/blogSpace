<?php

namespace App\Controllers;
use App\Core\Controller;

class AuthorArticlesController extends Controller
{
    public function edit(){
        $this->view('author/articles/edit', ['title' => 'Blog Space - edit article']);
    }
    public function create(){
        $this->view('author/articles/create', ['title' => 'Blog Space - create article']);
    }
    public function delete(){
    }
}