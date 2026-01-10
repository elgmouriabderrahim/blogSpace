<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Services\AdminUserService;

use App\Middlewears\Auth;
Auth::onlyAdmin();

class AdminUserController extends Controller
{
    public function index(){
        $users = AdminUserService::getAllUsers();
        $this->view('admin/users', [
            'title' => 'Blog Space - Manage Users',
            'users' => $users,
        ]);
    }

    public function banUser(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['user_id'];
            AdminUserService::banUser($id);
            header('Location: /admin/users');
            exit;
        }
    }
    public function unbanUser(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['user_id'];
            AdminUserService::unbanUser($id);
            header('Location: /admin/users');
            exit;
            
        }
    }
}
