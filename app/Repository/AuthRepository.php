<?php

namespace App\Repository;

use App\Core\Database;
use App\Models\Reader;
use App\Models\Admin;
use App\Models\Author;
use PDO;

class AuthRepository{
    public static function usernameExists(string $userName): bool{
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT 1 FROM users WHERE userName = :userName LIMIT 1");
        $stmt->execute([':userName' => $userName]);

        return (bool) $stmt->fetchColumn();
    }

    public static function emailExists(string $email): bool{
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare("SELECT 1 FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);

        return (bool) $stmt->fetchColumn();
    }

    public static function register(Reader $reader): void{
        $pdo = Database::getInstance()->getConnection();

        $sql = "INSERT INTO users 
                (firstName, lastName, userName, email, password, role, created_at)
                VALUES 
                (:firstName, :lastName, :userName, :email, :password, :role, :createdAt)";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':firstName' => $reader->getFirstName(),
            ':lastName'  => $reader->getLastName(),
            ':userName'   => $reader->getUserName(),
            ':email'      => $reader->getEmail(),
            ':password'   => $reader->getPassword(),
            ':role'       => $reader->getRole(),
            ':createdAt' => $reader->getCreatedAt()->format('Y-m-d H:i:s'),
        ]);
    }
    public static function getUserByEmail(string $email) {
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user){
        if($user['role'] === 'Reader')
            return new Reader($user['firstName'] ,$user['lastName'] ,$user['userName'] ,$user['email'] ,$user['password']);
        if($user['role'] === 'Author')
            return new Author($user['firstName'] ,$user['lastName'] ,$user['userName'] ,$user['email'] ,$user['password']);
        if($user['role'] === 'Admin')
            return new Admin($user['firstName'] ,$user['lastName'] ,$user['userName'] ,$user['email'] ,$user['password']);
    }
    return $user ?: null;
}
}
