<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
{foreach $categories as $cat}
    {if isset($cat.articles) && count($cat.articles) > 0}
        <div class="center-position">
            <div class="category">
                <div class="category__header">
                    <h2>{$cat.name}</h2>
                    <a href="?page=category&id={$cat.id}">
                        Все статьи
                    </a>
                </div>
                <div class="articles">
                    {foreach $cat.articles as $article}
                        {include file="components/article_card.tpl" article=$article}
                    {/foreach}
                </div>
            </div>
        </div>
    {/if}
{/foreach}