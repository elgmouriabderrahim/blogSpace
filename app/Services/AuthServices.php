<?php
namespace App\Services;
use App\Helpers\Helpers;
use App\Models\Reader;
use App\Repository\AuthRepository;
class AuthServices {
    static function register($firstName, $lastName, $userName, $email, $password, $cpassword){
        $errors = [];

        $errors = array_merge($errors, Helpers::validateFirstName($firstName));
        $errors = array_merge($errors, Helpers::validateLastName($lastName));
        $errors = array_merge($errors, Helpers::validateUsername($userName));
        $errors = array_merge($errors, Helpers::validateEmail($email));
        $errors = array_merge($errors, Helpers::validatePassword($password));
        $errors = array_merge($errors, Helpers::validateCPassword($password ,$cpassword));

        
        if(AuthRepository::emailExists($email))
            $errors = array_merge($errors, ['email' => "email already exists"]);
        
        if(AuthRepository::userNameExists($userName))
            $errors = array_merge($errors, ['userName' => "Username already exists"]);

        if(!empty($errors))
            return $errors;
        else{
            $reader = new Reader($firstName, $lastName, $userName, $email, password_hash($password, PASSWORD_DEFAULT));
            AuthRepository::register($reader);
            return [];
        }
    }
    static function login($email, $password){
        $errors = [];

        $errors = array_merge($errors, Helpers::validateEmail($email));
        if(empty($password))
            $errors = array_merge($errors, ['password' => 'Password is required']);

        if(!empty($errors))
            return $errors;

        $user = AuthRepository::getUserByEmail($email);
        if (!$user || !password_verify($password, $user->getPassword())) {
            return ['login' => 'Invalid email or password'];
        }
        
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user_name'] = $user->getUserName();
        $_SESSION['user_role'] = $user->getRole();

        return [];
    }
    
}