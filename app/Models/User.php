<?php
namespace App\Models;

abstract  class User {
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $userName;
    private string $email;
    private string $password;
    private string $role;
    private string $createdAt;
}