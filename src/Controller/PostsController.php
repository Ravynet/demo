<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/posts/create", name="post_create_path")
     */
    public function create(Request $request): Response
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('post_path', ['id' => $post->getId()]);
        }

        return $this->render('posts/create.html.twig', ['form' => $form->createView()]);
    }
}
