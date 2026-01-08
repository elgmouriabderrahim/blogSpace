<?php
namespace App\Controllers;
use App\Services\AdminCategoryService;
use App\Helpers\Helpers;
use App\Core\Controller;


class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = AdminCategoryService::getAll();

        $error = $_SESSION['error'] ?? null;
        unset($_SESSION['error']);

        $old_category_name = $_SESSION['old_category_name'] ?? null;
        unset($_SESSION['old_category_name']);

        $this->view('Admin/categories', [
            'title' => 'Blog Space - categories',
            'categories' => $categories,
            'error' => $error,
            'old_category_name' => $old_category_name
        ]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $error = Helpers::validateCategory($_POST['category_name'] ?? '');

            if (!$error) {
                if(AdminCategoryService::isCategoryExists($_POST['category_name'])){
                    $error = 'catrgory already exists';
                    $_SESSION['error'] = $error;
                    $_SESSION['old_category_name'] = $_POST['category_name'];
                }
                else
                    AdminCategoryService::create($_POST['category_name']);
            } else {
                $_SESSION['error'] = $error;
                $_SESSION['old_category_name'] = $_POST['category_name'];
            }
        }

        header('Location: /admin/categories');
        exit;
    }

    public function delete()
    {
        AdminCategoryService::delete((int)($_POST['category_id'] ?? 0));

        header('Location: /admin/categories');
        exit;
    }
}
