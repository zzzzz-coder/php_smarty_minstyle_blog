<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>{$article.title}</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <a href="/">Главная</a>
        <h1>{$article.title}</h1>
        <div class="article-list__image-position">
            <img src="{$article.image}" alt="" class="article-list__image">
        </div>
        <p class="article-list__description">{$article.description}</p>

        <div class="article-list__content">
            {$article.content}
        </div>

        <p>Просмотры: {$article.views}</p>

        <div class="article-list__categories-block">
            <h3 class="article-list__categories-head">Категории:</h3>
            <div class="article-list__categories-list">
                {foreach $categories as $cat}
                    <a href="?page=category&id={$cat.id}">
                        {$cat.name}
                    </a>
                {/foreach}
            </div>
        </div>

        <h3>Похожие статьи</h3>
        <div class="center-position">
            <div class="articles">
                <div class="articles">
                    {foreach $similar as $item}
                        {include file="components/article_card.tpl" article=$item}
                    {/foreach}
                </div>
            </div>
        </div>
    </body>
</html>