<?php
namespace App\Models;

class Reader extends User
{
    public function __construct(string $firstName ,string $lastName ,string $userName ,string $email ,string $password){
        parent::__construct(
            $firstName,
            $lastName,
            $userName,
            $email,
            $password,
            'Reader'
        );
    }
}
