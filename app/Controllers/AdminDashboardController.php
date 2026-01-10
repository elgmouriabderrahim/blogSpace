<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\AdminDashboardService;

class AdminDashboardController extends Controller
{
    public function index(){
        $stats = AdminDashboardService::getDashboardStats();
        $activities = AdminDashboardService::getRecentActivities(10);

        $this->view('admin/dashboard', [
            'title' => 'Blog Space - Admin Dashboard',
            'stats' => $stats,
            'activities' => $activities
        ]);
    }
}
