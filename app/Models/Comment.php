<?php
namespace App\Models;

class Comment {
    private int $id;
    private string $content;
    private int $user_id;
    private int $article_id;
    private string $created_at;
    private string $reader_name;
    private int $likes_count;
    private bool $likedByReader;

    public function __construct(array $data){
        $this->id = $data['id'];
        $this->content = $data['content'];
        $this->user_id = $data['reader_id'];
        $this->article_id = $data['article_id'];
        $this->created_at = $data['created_at'];
        $this->reader_name = $data['reader_name'];
        $this->likes_count = $data['likes_count'];
        $this->likedByReader = $data['liked_by_reader'] ?? false;
    }

    public function getId(): int { return $this->id; }
    public function getContent(): string { return $this->content; }
    public function getCreatedAt(): string { return $this->created_at; }
    public function getReaderId(): int { return $this->user_id; }
    public function getReaderName(): string { return $this->reader_name; }
    public function getLikesCount(): int { return $this->likes_count; }
    public function isLikedByReader(): bool { return $this->likedByReader; }
}
