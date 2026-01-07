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
            $reader = new Reader($firstName, $lastName, $userName, $email, $password);
            AuthRepository::register($reader);
            return [];
        }
    }
}