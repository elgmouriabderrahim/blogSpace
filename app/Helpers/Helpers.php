<?php
namespace App\Helpers;
class Helpers {
    static function sanitize(string $data): string {
        return trim($data);
    }
    static function validateFirstName($firstName){
        $firstName = self::sanitize($firstName);

        if($firstName === '')
            return ['firstName' => 'First name is required'];

        if(!preg_match('/^[\p{L} ]{3,50}$/u', $firstName))
            return ['firstName' => 'Invalid name'];

        return [];
    }
    static function validateLastName($lastName){
        $lastName = self::sanitize($lastName);

        if($lastName === '')
            return ['lastName' => 'Last name is required'];

        if(!preg_match('/^[\p{L} ]{3,50}$/u', $lastName))
            return ['lastName' => 'Invalid name'];

        return [];
    }
    static function validateUserName($userName){
        $userName = self::sanitize($userName);

        if($userName === '')
            return ['userName' => 'Username is required'];

        if(!preg_match('/^[\p{L}\d._-]{3,50}$/u', $userName))
            return ['userName' => 'Invalid username'];

        return [];
    }
    static function validateEmail($email){
        $email = self::sanitize($email);

        if($email === '')
            return ['email' => 'Email is required'];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            return ['email' => 'Invalid email'];
        
        return [];
    }
    static function validatePassword($password){
        if($password === '')
            return ['password' => 'Password is required'];

        if(!preg_match('/^(?=.*[A-Za-z])(?=.*\d).{5,}$/', $password))
            return ['password' => 'Weak password'];

        return [];
    }
    static function validateCPassword($password, $cpassword){
        if($cpassword === '')
            return ['cpassword' => 'Password confirmation is required'];
        elseif($password !== $cpassword)
            return ['cpassword' => 'password dont match'];

        return [];
    }
}