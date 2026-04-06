<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/app/config/db.php';
$smarty = require __DIR__ . '/app/config/smarty.php';

require __DIR__ . '/app/models/Article.php';
require __DIR__ . '/app/models/Category.php';
$page = $_GET['page'] ?? 'home';

if ($page === 'article') {

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id <= 0) die('Invalid ID');

    Article::incrementViews($pdo, $id);

    $article = Article::getById($pdo, $id);
    if (!$article) {
        http_response_code(404);
        die('Article not found');
    }

    $similar = Article::getSimilar($pdo, $id);
    $categories = Article::getCategories($pdo, $id);

    $smarty->assign('article', $article);
    $smarty->assign('similar', $similar);
    $smarty->assign('categories', $categories);

    $smarty->display('article.tpl');

} elseif ($page === 'category') {

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    if ($id <= 0) die('Invalid ID');

    $sort = $_GET['sort'] ?? 'date';
    if (!in_array($sort, ['date', 'views'])) {
        $sort = 'date';
    }

    $pageNum = isset($_GET['p']) ? (int)$_GET['p'] : 1;
    $pageNum = max(1, $pageNum);

    $limit = 20;
    $offset = ($pageNum - 1) * $limit;

    $category = Category::getById($pdo, $id);
    if (!$category) {
        http_response_code(404);
        die('Category not found');
    }

    $articles = Article::getByCategory($pdo, $id, $sort, $limit, $offset);
    $total = Article::countByCategory($pdo, $id);

    $pages = ceil($total / $limit);

    $smarty->assign('category', $category);
    $smarty->assign('articles', $articles);
    $smarty->assign('total', $total);
    $smarty->assign('pageNum', $pageNum);
    $smarty->assign('limit', $limit);
    $smarty->assign('pages', $pages);

    $smarty->display('category.tpl');

} else {

    $categories = Category::getAll($pdo);

    foreach ($categories as $i => $cat) {
        $categories[$i]['articles'] = Article::getLatestByCategory($pdo, $cat['id']);
    }

    $smarty->assign('categories', $categories);
    $smarty->display('index.tpl');
}