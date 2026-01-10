<?php
namespace App\Middlewears;
class Auth {
    public static function onlyUser(){
        if(!isset($_SESSION['user_id'])){
            header("location: /");
            exit;
        }
    }
    public static function onlyGuest(){
        if(isset($_SESSION['user_id'])){
            header("location: /");
            exit;
        }
    }
    public static function onlyAdmin(){
        if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== "Admin"){
            header("location: /");
            exit;
        }
    }
    public static function onlyAuthor(){
        if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== "Author"){
            header("location: /");
            exit;
        }
    }
    public static function onlyReader(){
        if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== "Author"){
            header("location: /");
            exit;
        }
    }
}