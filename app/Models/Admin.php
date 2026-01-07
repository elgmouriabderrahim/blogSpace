<?php
namespace App\Models;

class Admin extends User {

    public function __construct(string $firstName ,string $lastName ,string $userName ,string $email ,string $password){
        parent::__construct(
            $firstName,
            $lastName,
            $userName,
            $email,
            $password,
            'Admin'
        );
    }
    public function manageCategories() {}
    public function manageUsers() {}
}
