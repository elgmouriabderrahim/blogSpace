<?php
namespace App\Repository;

use App\Core\Database;
use App\Models\Article;
use PDO;

class HomeRepository {

   public static function getAllArticles(): array {
    $db = Database::getInstance()->getConnection();

    $stmt = $db->query(
        "SELECT a.*, CONCAT(u.firstName, ' ', u.lastName) AS author_name,
        (select count(*) from comments c where c.article_id = a.id) as comments_count,
        (select count(*) from likes l where l.article_id = a.id)as likes_count
         FROM articles a
         JOIN users u ON a.author_id = u.id
         WHERE a.status = 'published'
         ORDER BY a.created_at DESC"
    );

    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return array_map(function($article) {
        return new Article($article);
    }, $articles);
}

}
