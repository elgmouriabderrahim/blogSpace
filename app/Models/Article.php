<?php
namespace App\Models;

class Article {
    private ?int $id;
    private string $title;
    private string $content;
    private int $authorId;
    private ?string $authorName;
    private ?int $likesCount;
    private ?int $commentsCount;
    private string $createdAt;
    private ?string $updatedAt;
    public string $status;

    public function __construct(array $data){
        $this->id = $data['id'] ?? null;
        $this->authorId = $data['author_id'];
        $this->title = $data['title'];
        $this->content = $data['content'];
        $this->createdAt = $data['created_at'];
        $this->updatedAt = $data['updated_at'] ?? null;
        $this->status = $data['status'];
        $this->authorName = $data['author_name'];
        $this->likesCount = $data['likes_count'] ?? null;
        $this->commentsCount = $data['comments_count'] ?? null;
    }

    public function getId(): int { return $this->id; }
    public function getTitle(): string { return $this->title; }
    public function getContent(): string { return $this->content; }
    public function getAuthorId(): int { return $this->authorId; }
    public function getAuthorName(): string { return $this->authorName; }
    public function getStatus(): string { return $this->status; }
    public function getCreatedAt(): string { return $this->createdAt; }
    public function getUpdatedAt(): ?string { return $this->updatedAt; }
    public function getLikesCount(): int { return $this->likesCount; }
    public function getCommentsCount(): int { return $this->commentsCount; }
    

    public function setTitle(string $title): void { $this->title = $title; }
    public function setContent(string $content): void { $this->content = $content; }
    public function setStatus(string $status): void { $this->status = $status; }
    public function setUpdatedAt(string $date): void { $this->updatedAt = $date; }
}