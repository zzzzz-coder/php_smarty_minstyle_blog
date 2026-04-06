<?php

class Article {

    public static function getById($pdo, $id) {
        $stmt = $pdo->prepare("
            SELECT * FROM articles WHERE id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function incrementViews($pdo, $id) {
        $stmt = $pdo->prepare("
            UPDATE articles SET views = views + 1 WHERE id = ?
        ");
        $stmt->execute([$id]);
    }

    public static function getLatestByCategory($pdo, $categoryId) {
        $stmt = $pdo->prepare("
            SELECT a.* FROM articles a
            JOIN article_category ac ON a.id = ac.article_id
            WHERE ac.category_id = ?
            ORDER BY a.created_at DESC
            LIMIT 3
        ");
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getByCategory($pdo, $categoryId, $sort, $limit, $offset) {

        $order = $sort === 'views' ? 'a.views DESC' : 'a.created_at DESC';

        $stmt = $pdo->prepare("
            SELECT a.* FROM articles a
            JOIN article_category ac ON a.id = ac.article_id
            WHERE ac.category_id = ?
            ORDER BY $order
            LIMIT $limit OFFSET $offset
        ");

        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function countByCategory($pdo, $categoryId) {
        $stmt = $pdo->prepare("
            SELECT COUNT(*) FROM article_category
            WHERE category_id = ?
        ");
        $stmt->execute([$categoryId]);
        return $stmt->fetchColumn();
    }

    public static function getSimilar($pdo, $id) {
        $stmt = $pdo->prepare("
            SELECT * FROM articles
            WHERE id != ?
            ORDER BY RAND()
            LIMIT 3
        ");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function getCategories($pdo, $articleId) {
    $stmt = $pdo->prepare("
        SELECT c.* FROM categories c
        JOIN article_category ac ON c.id = ac.category_id
        WHERE ac.article_id = ?
    ");
    $stmt->execute([$articleId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}