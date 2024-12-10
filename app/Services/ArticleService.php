<?php

namespace App\Services;

use App\Models\Article;

class ArticleService
{
    public function getExcerpt(string $text, int $length = 100): string
    {
        return mb_substr($text, 0, $length) . '...';
    }
}
