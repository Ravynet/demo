<?php

namespace App\Services;

use App\Entity\Post;
use Statickidz\GoogleTranslate;

class TranslateService
{

    private $translator;

    /**
     * TranslateService constructor.
     * @param GoogleTranslate $translator
     */
    public function __construct(GoogleTranslate $translator)
    {
        $this->translator = $translator;
    }


    /**
     * @param string $target
     * @param Post $post
     * @param null|string $source
     * @return Post|null
     */
    public function translate(string $target, Post $post, ?string $source = null): ?Post
    {
        $post->setDescription($this->translator->translate($source, $target, $post->getDescription()));

        return $post;
    }

}
