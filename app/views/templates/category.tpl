<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>Главная</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <a href="/">Главная</a>
        <h1>{$category.name}</h1>
        <p>{$category.description}</p>

        <div>
            <a href="?page=category&id={$category.id}&sort=date">По дате</a>
            <a href="?page=category&id={$category.id}&sort=views">По просмотрам</a>
        </div>

        <div class="articles">
            {foreach $articles as $article}
                {include file="components/article_card.tpl" article=$article}
            {/foreach}
        </div>

        {if $pages > 1}
            <div>
                {for $i=1 to $pages}
                    <a href="?page=category&id={$category.id}&p={$i}">
                        {$i}
                    </a>
                {/for}
            </div>
        {/if}
    </body>
</html>