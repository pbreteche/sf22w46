<?php

namespace App\Message;

use App\Entity\Article;

class ArticleMessage
{
    /** @var Article */
    private $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function getArticle(): Article
    {
        return $this->article;
    }
}