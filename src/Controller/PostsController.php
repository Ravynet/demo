<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PostsController extends Controller
{
    /**
     * @Route("/posts", name="posts_path")
     */
    public function index(PostRepository $repository): Response
    {
        $posts = $repository->findAll();

        return $this->render('posts/index.html.twig', compact('posts'));
    }

    /**
     * @Route("/posts/{id}", name="post_path", requirements={"id": "[0-9]+"})
     */
    public function show(Post $post): Response
    {
        return $this->render('posts/show.html.twig', compact('post'));
    }
}
