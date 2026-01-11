<?php
namespace App\Services;

use App\Repository\ReaderArticleRepository;
use App\Helpers\Helpers;

class ReaderArticleService {

    public static function getArticle(int $id) {
        return ReaderArticleRepository::findArticleById($id);
    }

    public static function getComments(int $articleId): array {
        return ReaderArticleRepository::getCommentsByArticleId($articleId);
    }

    public static function addComment(int $articleId, int $readerId, string $content): array {
        $content = Helpers::sanitize($content);
        $errors = [];
        if ($content === '') {
            $errors['content'] = 'Comment cannot be empty';
            return $errors;
        }
        ReaderArticleRepository::addComment($articleId, $readerId, $content);
        return $errors;
    }

    public static function deleteComment(int $commentId, int $readerId): void {
        ReaderArticleRepository::deleteComment($commentId, $readerId);
    }

    public static function likeArticle(int $articleId, int $readerId): void {
        ReaderArticleRepository::likeArticle($articleId, $readerId);
    }

    public static function unlikeArticle(int $articleId, int $readerId): void {
        ReaderArticleRepository::unlikeArticle($articleId, $readerId);
    }

    public static function likeComment(int $commentId, int $readerId): void {
        ReaderArticleRepository::likeComment($commentId, $readerId);
    }

    public static function unlikeComment(int $commentId, int $readerId): void {
        ReaderArticleRepository::unlikeComment($commentId, $readerId);
    }
}
