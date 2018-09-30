<?php

namespace App\Services;

use App\Entity\Post;
use \Statickidz\GoogleTranslate;

class TranslateService
{

    public function translate(string $source = null, string $target = null, Post $post): Post
    {
        $translate = new GoogleTranslate();
        $post->setDescription($translate->translate($source, $target, $post->getDescription()));

        return $post;
    }

}
