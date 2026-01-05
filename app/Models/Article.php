<?php
namespace App\Models;

class Article {
    private int $id;
    private string $title;
    private string $content;
    private int $author_id;
    private string $created_at;
    private ?string $updated_at;

    public function comments() {}
    public function categories() {}
    public function likes() {}
}