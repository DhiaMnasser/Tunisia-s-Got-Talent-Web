<?php

namespace ForumBundle\Controller;

use ForumBundle\Entity\Discussion;
use ForumBundle\Entity\Post;
use ForumBundle\ForumBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Post controller.
 *
 */
class PostController extends Controller
{
    /**
     * Lists all post entities.
     *
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $posts = $em->getRepository('ForumBundle:Post')->findAll();

        return $this->render('@Forum/post/index.html.twig', array(
            'posts' => $posts,
        ));
    }

    /**
     * Creates a new post entity.
     *
     */
    public function newAction(Request $request)
    {
        $post = new Post();
        $post->setDate(new \DateTime('now'));
        $form = $this->createForm('ForumBundle\Form\PostType', $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('post_index', array('id' => $post->getId()));
        }

        return $this->render('@Forum/post/new.html.twig', array(
            'post' => $post,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a post entity.
     *
     */



    /**
     * Displays a form to edit an existing post entity.
     *
     */
    public function editAction(Request $request, Post $post)
    {
        $editForm = $this->createForm('ForumBundle\Form\PostType', $post);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_index');
        }

        return $this->render('@Forum/post/edit.html.twig', array(
            'post' => $post,
            'edit_form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a post entity.
     *
     */
    public function deleteAction(Request $request, Post $post)
    {
        $discu=$this->getDoctrine()->getRepository(Discussion::class)->findall();
        $em=$this->getDoctrine()->getManager();
        $i=0;
        while ($i<count($discu)){
            $em->remove($discu[$i]);
            $i=$i+1;
        }
        $em->flush();

        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();


        return $this->redirectToRoute('post_index');
    }

    /**
     * Creates a form to delete a post entity.
     *
     * @param Post $post The post entity
     *
     * @return \Symfony\Component\Form\Form The form
     */

    public function readUAction($id)
    {

        $em = $this->getDoctrine()->getManager();
        $discussion = $em->getRepository("ForumBundle:Discussion")->findDiscussion($id);
        return $this->render('@Forum/post/readU.html.twig', array('discussion'=>$discussion,'id'=>$id));

    }
}
