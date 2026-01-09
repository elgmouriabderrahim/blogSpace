<?php
namespace App\Midllewears;
class Auth {
    public static function isUser(){
        if(!isset($_SESSION['user_id']))
            header("location: /");
    }
    public static function isAdmin(){
        if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== "Admin")
            header("location: /");
    }
    public static function isAuthor(){
        if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== "Author")
            header("location: /");
    }
    public static function isReader(){
        if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== "Author")
            header("location: /");
    }
}