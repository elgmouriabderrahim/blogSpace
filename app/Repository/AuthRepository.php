<?php

namespace App\Repository;

use App\Core\Database;
use App\Models\Reader;
use App\Models\Admin;
use App\Models\Author;
use PDO;

use App\Helpers\Helpers;

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
            ':createdAt' => $reader->getCreatedAt(),
        ]);
    }
    public static function getUserByEmail(string $email) {
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user)
        return Helpers::createUser($user);
    else
        return null;
}
}
