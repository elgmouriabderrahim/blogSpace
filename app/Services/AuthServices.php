<?php
namespace App\Services;
use App\Helpers\Helpers;
use App\Models\Reader;
use App\Repository\AuthRepository;
class AuthServices {
    static function register(array $inputdata){

        $errors = Helpers::validateRegisterInputs($inputdata);
        
        if(AuthRepository::emailExists($inputdata['email']))
            $errors = array_merge($errors, ['email' => "email already exists"]);
        
        if(AuthRepository::userNameExists($inputdata['userName']))
            $errors = array_merge($errors, ['userName' => "Username already exists"]);

        if(!empty($errors))
            return $errors;
        else{
            $inputdata['password'] = password_hash($inputdata['password'], PASSWORD_DEFAULT);
            unset($inputdata['cpassword']);
            $reader = new Reader([...$inputdata, 'created_at' => date('Y-m-d H:i:s'), 'is_banned' => 0]);
            AuthRepository::register($reader);
            return [];
        }
    }
    static function login($inputdata){

        $errors = Helpers::validateLoginInputs($inputdata);

        if(!empty($errors))
            return $errors;

        $user = AuthRepository::getUserByEmail($inputdata['email']);
        if (!$user || !password_verify($inputdata['password'], $user->getPassword())) {
            return ['login' => 'Invalid email or password'];
        }
        
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user_firstName'] = $user->getFirstName();
        $_SESSION['user_lastName'] = $user->getLastName();
        $_SESSION['user_name'] = $user->getUserName();
        $_SESSION['user_role'] = $user->getRole();

        return [];
    }
    
}