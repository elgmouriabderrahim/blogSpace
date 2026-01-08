<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\AdminDashboardService;

class AdminDashboardController extends Controller
{
    public function index(){
        $stats = AdminDashboardService::getDashboardStats();

        $this->view('admin/dashboard', [
            'title' => 'Admin Dashboard',
            'stats' => $stats
        ]);
    }
}
