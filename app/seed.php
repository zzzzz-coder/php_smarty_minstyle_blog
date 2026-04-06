<?php

require __DIR__ . '/config/db.php';

// создаём категории
for ($i = 1; $i <= 3; $i++) {
    $pdo->prepare("
        INSERT INTO categories (name, description)
        VALUES (?, ?)
    ")->execute([
        "Category $i",
        "Description $i"
    ]);
}

// создаём статьи
for ($i = 1; $i <= 10; $i++) {

    $stmt = $pdo->prepare("
        INSERT INTO articles (title, description, content, image)
        VALUES (?, ?, ?, ?)
    ");

    $images = glob(__DIR__ . '/../public/images/*.png');
    $imagePath = $images[array_rand($images)];
    $imageName = basename($imagePath);

    $stmt->execute([
        "Post $i",
        "Desc $i",
        "Content $i",
        "/public/images/" . $imageName
    ]);

    $articleId = $pdo->lastInsertId();

    $pdo->prepare("
        INSERT INTO article_category (article_id, category_id)
        VALUES (?, ?)
    ")->execute([$articleId, rand(1,3)]);
}