<?php
namespace App\Helpers;
use App\Models\Reader;
use App\Models\Admin;
use App\Models\Author;
class Helpers {
    static function sanitize(string $data): string {
        return trim($data);
    }

    static function validateRegisterInputs(array $inputData){

        $firstName = self::sanitize($inputData['firstName']);
        $lastName = self::sanitize($inputData['lastName']);
        $userName = self::sanitize($inputData['userName']);
        $email = self::sanitize($inputData['email']);

        $errors = [];

        if(!preg_match('/^[\p{L} ]{3,50}$/u', $firstName))
            $errors['firstName'] = 'Invalid name';
        if($firstName === '')
            $errors['firstName'] = 'First name is required';

        if(!preg_match('/^[\p{L} ]{3,50}$/u', $lastName))
            $errors['lastName'] = 'Invalid name';
        if($lastName === '')
            $errors['lastName'] = 'Last name is required';

        if(!preg_match('/^[\p{L}\d._-]{3,50}$/u', $userName))
            $errors['userName'] = 'Invalid username';
        if($userName === '')
            $errors['userName'] = 'Username is required';

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            $errors['email'] = 'Invalid email';
        if($email === '')
            $errors['email'] = 'Email is required';

        if(!preg_match('/^(?=.*[A-Za-z])(?=.*\d).{5,}$/', $inputData['password']))
            $errors['password'] = 'Weak password';
        if($inputData['password'] === '')
            $errors['password'] = 'Password is required';

        elseif($inputData['password'] !== $inputData['cpassword'])
            $errors['cpassword'] = 'password dont match';
        if($inputData['cpassword'] === '')
            $errors['cpassword'] = 'Password confirmation is required';

        return $errors;
    }

    public static function validateLoginInputs($inputData){
        $email = self::sanitize($inputData['email']);

        $errors =[];

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            $errors['email'] = 'Invalid email';
        if($email === '')
            $errors['email'] = 'Email is required';

        if($inputData['password'] === '')
            $errors['password'] = 'Password is required';
        
        return $errors;
    }

    public static function validatecategory($categoryname){
        $categoryname = self::sanitize($categoryname);

        if($categoryname === '')
            return 'category name is required';

        if(!preg_match('/^[\p{L} \d]{5,50}$/u', $categoryname))
            return 'Invalid category name';
        
        return null;
    }

    static function validateArticle($title, $content, $status, $categories){
        $title = self::sanitize($title);
        $content = self::sanitize($content);
        $status = self::sanitize($status);
        $errors = [];
        if($title === '')
            $errors['title'] = 'Title is required';

        if($content === '')
            $errors['content'] = 'Content is required';

        if($status !== 'Draft' && $status !== 'Published')
            $errors['status'] = 'Invalid status';

        if(!preg_match('/^[\p{L} \d]{3,50}$/u', $title))
            $errors['title'] = 'Invalid Title';

        if($content !== '' && !preg_match('/^.{20,}$/', $content))
            $errors['content'] = 'Content must be at least 20 character';

        if(empty($categories))
            $errors['categories'] = "Select one category at least";
        
        return $errors;
    }

    public static function createUser(array $data){
        return $data['role'] === 'Reader' ? new Reader($data) :
        ($data['role'] === 'Admin' ? new Admin($data) :
        ($data['role'] === 'Author' ? new Author($data) : null));
    }

}