<?php

namespace App\Services;

use App\Entity\Post;
use \Statickidz\GoogleTranslate;

class TranslateService
{

    public function translate(string $source, string $target, Post $post)
    {
        $translate = new GoogleTranslate();
        $post->setDescription($translate->translate($source, $target, $post->getDescription()));

        return $post;
    }

}