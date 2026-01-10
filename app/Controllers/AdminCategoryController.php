<?php
namespace App\Controllers;
use App\Services\AdminCategoryService;
use App\Helpers\Helpers;
use App\Core\Controller;

use App\Middlewears\Auth;
Auth::onlyAdmin();

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = AdminCategoryService::getAllCategories();

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
            $categoryName = $_POST['category_name'] ?? '';
            $error = AdminCategoryService::validateCategory($categoryName);

            if (!$error) {
                if(AdminCategoryService::isCategoryExists($categoryName)){
                    $error = 'catrgory already exists';
                    $_SESSION['error'] = $error;
                    $_SESSION['old_category_name'] = $categoryName;
                }
                else
                    AdminCategoryService::create($categoryName);
            } else {
                $_SESSION['error'] = $error;
                $_SESSION['old_category_name'] = $categoryName;
            }
        }

        header('Location: /admin/categories');
        exit;
    }

    public function delete()
    {
        AdminCategoryService::delete(($_POST['category_id'] ?? null));

        header('Location: /admin/categories');
        exit;
    }
}
