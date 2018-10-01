<?php

namespace App\Controller\Api;

use App\Entity\Post;
use FOS\RestBundle\Controller\FOSRestController;

class PostController extends FOSRestController
{

    public function getPostsAction()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();

        return $posts;
    }
}
