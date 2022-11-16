<?php

namespace App\Utils;

use App\Entity\Article;

class ArticleProcessor
{
    public function timeDiff(Article $a1, Article $a2): \DateInterval
    {
        return $a1->getPublishedAt()->diff($a2->getPublishedAt());
    }
}
