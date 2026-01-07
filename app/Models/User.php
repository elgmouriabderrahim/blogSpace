<?php
namespace App\Models;

abstract class User
{
    private ?int $id = null;
    private string $firstName;
    private string $lastName;
    private string $userName;
    private string $email;
    private string $password;
    private string $role;
    private \DateTimeImmutable $createdAt;

    public function __construct(string $firstName ,string $lastName ,string $userName ,string $email ,string $password ,string $role){
        $this->firstName = $firstName;
        $this->lastName  = $lastName;
        $this->userName  = $userName;
        $this->email     = $email;
        $this->password  = password_hash($password, PASSWORD_DEFAULT);
        $this->role      = $role;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int { return $this->id; }
    public function getFirstName(): string { return $this->firstName; }
    public function getLastName(): string { return $this->lastName; }
    public function getUserName(): string { return $this->userName; }
    public function getEmail(): string { return $this->email; }
    public function getPassword(): string { return $this->password; }
    public function getRole(): string { return $this->role; }
    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }

    public function changeEmail(string $email): void
    {
        $this->email = $email;
    }

    public function changePassword(string $plainPassword): void
    {
        $this->password = password_hash($plainPassword, PASSWORD_DEFAULT);
    }

    public function verifyPassword(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->password);
    }
}
