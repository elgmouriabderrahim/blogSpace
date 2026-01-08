<?php

namespace App\Controllers;
use App\Core\Controller;

class UsersController extends Controller
{
    public function index(){
        $this->view('Admin/users', ['title' => 'Blog Space - users']);
    }
}