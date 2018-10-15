<?php

namespace App\Controller\Api;

use App\Entity\Post;
use App\Form\PostType;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\View;

class PostController extends FOSRestController
{

    /**
     * @View(
     *     serializerGroups={"view_users"}
     * )
     */
    public function getPostsAction()
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();

        return $posts;
    }

    public function postPostsAction(Request $request)
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->submit($request->request->all());

        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $post;
        }
        return $form->getErrors();
    }
}
