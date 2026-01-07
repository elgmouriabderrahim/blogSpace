<?php
namespace App\Models;

class Author extends User {

    public function __construct(string $firstName ,string $lastName ,string $userName ,string $email ,string $password){
        parent::__construct(
            $firstName,
            $lastName,
            $userName,
            $email,
            $password,
            'Author'
        );
    }

    public function createArticle() {}
    public function editArticle() {}
    public function deleteArticle() {}
}
