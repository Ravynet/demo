<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Services\ShiftPostDateService;

class PostsController extends Controller
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/posts", name="posts_path", methods={"GET"})
     */
    public function index(PostRepository $repository): Response
    {
        $posts = $repository->findAll();

        return $this->render('posts/index.html.twig', compact('posts'));
    }

    /**
     * @Route("/posts/{id}", name="post_path", requirements={"id": "[0-9]+"}, methods={"GET"})
     */
    public function show(Post $post): Response
    {
        return $this->render('posts/show.html.twig', compact('post'));
    }

    /**
     * @Route("/posts/create", name="post_create_path", methods={"POST", "GET"})
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function create(Request $request): Response
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->persist($post);
            $this->em->flush();

            return $this->redirectToRoute('post_path', ['id' => $post->getId()]);
        }

        return $this->render('posts/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/posts/{id}/edit", name="post_edit_path", requirements={"id": "[0-9]+"}, methods={"POST", "GET", "PATCH"})
     */
    public function edit(Post $post, Request $request): Response
    {
        $shiftPostDateService = $this->get(ShiftPostDateService::class);

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->em->flush();

            $shiftPostDateService->shiftPostDate($post, 5);

            return $this->redirectToRoute('post_path', ['id' => $post->getId()]);
        }

        return $this->render('posts/edit.html.twig', [
            'post' => $post,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/posts/{id}", name="post_delete_path", requirements={"id": "[0-9]+"}, methods={"DELETE"})
     */
    public function delete(Post $post, Request $request): Response
    {
        if ($this->isCsrfTokenValid('delete', $request->request->get('token'))) {
            $this->em->remove($post);
            $this->em->flush();
        }

        return $this->redirectToRoute('posts_path');
    }
}