<?php
namespace App\Models;

class Comment {
    private int $id;
    private string $content;
    private int $user_id;
    private int $article_id;
    private string $created_at;
    private function user() {}
    private function article() {}
}