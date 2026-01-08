<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Services\AdminUserService;

class AdminUserController extends Controller
{
    public function index(){
        $users = AdminUserService::getAllUsers();

        $this->view('admin/users', [
            'title' => 'Blog Space - Manage Users',
            'users' => $users
        ]);
    }

    public function toggleBan($id)
    {
        AdminUserService::toggleBan($id);
        header('Location: /admin/users');
        exit;
    }
}
