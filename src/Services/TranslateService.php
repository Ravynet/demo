<?php

namespace App\Services;

use App\Entity\Post;
use Statickidz\GoogleTranslate;

class TranslateService
{

    private $translator;

    public function __construct(GoogleTranslate $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param string|null $source
     * @param string|null $target
     * @param Post $post
     * @return Post
     */
    public function translate(?string $target, Post $post, ?string $source = null): ?Post
    {
        $post->setDescription($this->translator->translate($source, $target, $post->getDescription()));

        return $post;
    }

}
