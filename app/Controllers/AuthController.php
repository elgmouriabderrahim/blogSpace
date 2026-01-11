<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\AuthServices;

class AuthController extends Controller
{
    public function register(){
        $this->view('Register', ['title'  => 'Blog space - Register']);
    }
    public function registerform(){
        $inputData = [
        'firstName' => $_POST['firstName'],
        'lastName'  => $_POST['lastName'],
        'userName'  => $_POST['userName'],
        'email'     => $_POST['email'],
        'password'  => $_POST['password'],
        'cpassword' => $_POST['cpassword']
        ];

        $errors = AuthServices::register($inputData);

        if (empty($errors)) {
            header('Location: /login');
            exit;
        }

        $this->view('Register', [
            'title'  => 'Blog space - Register',
            'errors' => $errors,
            'inputData'    => $inputData
        ]);
    }

    public function login(){
        $this->view('login', ['title' => 'Blogspace - Log In']);
    }
    public function loginform(){
        $inputData = [
            'email' => $_POST['email'],
            'password' => $_POST['password']
        ];

        $errors = AuthServices::login($inputData);

        if (empty($errors)) {
            header('Location: /');
            exit;
        }

        $this->view('login', [
            'title' => 'Blogspace - Log In',
            'errors' => $errors,
            'inputData' => $inputData
        ]);
    }

    public function logout(){
        session_unset();
        session_destroy();
        header('Location: /login');
        exit;
    }
}
