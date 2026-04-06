<div class="article-card">
    <img class="article-card__img" src="{$article.image}" alt="">

    <h2>{$article.title}</h2>

    <p>{$article.description}</p>

    <p>Просмотры: {$article.views}</p>

    <a href="?page=article&id={$article.id}">
        Читать далее
    </a>
</div>