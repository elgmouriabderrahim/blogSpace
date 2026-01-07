<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\AuthServices;

class AuthController extends Controller
{
    public function register()
    {
        $errors = [];
        $old = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['firstName'] ?? '';
            $lastName  = $_POST['lastName'] ?? '';
            $userName  = $_POST['userName'] ?? '';
            $email     = $_POST['email'] ?? '';
            $password  = $_POST['password'] ?? '';
            $cpassword = $_POST['cpassword'] ?? '';

            $old = [
                'firstName' => $firstName,
                'lastName'  => $lastName,
                'userName'  => $userName,
                'email'  => $email,
            ];

            $errors = AuthServices::register($firstName, $lastName, $userName, $email, $password, $cpassword);

            if (empty($errors)) {
                header('Location: /login');
                exit;
            }
        }

        $this->view('Register', [
            'title'  => 'Blog space - Register',
            'errors' => $errors,
            'old'    => $old
        ]);
    }

    public function login()
    {
        $this->view('login', ['title' => 'Blogspace - Log In']);
    }
}
