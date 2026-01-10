<?php
namespace App\Models;

abstract class User
{
    private ?int $id;
    private string $firstName;
    private string $lastName;
    private string $userName;
    private string $email;
    private string $password;
    private string $role;
    private string $createdAt;
    private bool $isBanned;

    public function __construct($data){
        $this->id = $data['id'] ?? null;
        $this->firstName = $data['firstName'];
        $this->lastName  = $data['lastName'];
        $this->userName  = $data['userName'];
        $this->email     = $data['email'];
        $this->password  = $data['password'];
        $this->role      = $data['role'];
        $this->createdAt = $data['created_at'];
        $this->isBanned = $data['is_banned'];
    }

    public function getId(): ?int { return $this->id; }
    public function getFirstName(): string { return $this->firstName; }
    public function getLastName(): string { return $this->lastName; }
    public function getUserName(): string { return $this->userName; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getRole(): string { return $this->role; }
    public function getCreatedAt(): string { return $this->createdAt; }
    public function isBanned(): string { return $this->isBanned; }


    public function verifyPassword(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->password);
    }
}
