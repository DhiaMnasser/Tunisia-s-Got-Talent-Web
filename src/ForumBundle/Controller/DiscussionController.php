<?php

namespace ForumBundle\Controller;

use ForumBundle\Entity\Discussion;
use ForumBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Discussion controller.
 *
 */
class DiscussionController extends Controller
{
    /**
     * Lists all discussion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $discussions = $em->getRepository('ForumBundle:Discussion')->findAll();

        return $this->render('@Forum/discussion/index.html.twig', array(
            'discussions' => $discussions,
        ));
    }

    /**
     * Creates a new discussion entity.
     *
     */
    public function newAction(Request $request,$id)

    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('ForumBundle:Post')->find($id);
        $discussion = new Discussion();
        $user = $this->getUser();
        $discussion->setUser($user);
        $discussion->setDate(new \DateTime('now'));

        $discussion->setPost($post);
        $form = $this->createForm('ForumBundle\Form\DiscussionType', $discussion);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($discussion);
            $em->flush();

            return $this->redirectToRoute('post_readU', array('id' => $id ));
        }

        return $this->render('@Forum/discussion/new.html.twig', array(
            'discussion' => $discussion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a discussion entity.
     *
     */
    public function showAction(Discussion $discussion)
    {


        return $this->render('@Forum/discussion/show.html.twig', array(
            'discussion' => $discussion,

        ));
    }

    /**
     * Displays a form to edit an existing discussion entity.
     *
     */
    public function editAction(Request $request, Discussion $discussion)
    {$id=$discussion->getPostId();


        $editForm = $this->createForm('ForumBundle\Form\DiscussionType', $discussion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_readU', array('id' => $id));
        }

        return $this->render('@Forum/discussion/edit.html.twig', array(
            'discussion' => $discussion,
            'edit_form' => $editForm->createView(),

        ));
    }

    /**
     * Deletes a discussion entity.
     *
     */
    public function deleteAction(Request $request, Discussion $discussion)
    {
        $id=$discussion->getPostId();



        $em = $this->getDoctrine()->getManager();
        $em->remove($discussion);
        $em->flush();


        return $this->redirectToRoute('post_readU', array('id' => $id));
    }

    /**
     * Creates a form to delete a discussion entity.
     *
     * @param Discussion $discussion The discussion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */

}
