<?php

namespace AssistanceBundle\Controller;

use Symfony\Component\HttpFoundation\Response;
use TGT\AssistanceBundle\Entity\Appreciation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;
use TGT\EvaluationBundle\Entity\Publication;
use TGT\UserBundle\Entity\User;



/**
 * Appreciation controller.
 *
 * @Route("appreciation")
 */
class AppreciationController extends Controller
{
    /**
     * Lists all appreciation entities.
     *
     * @Route("/index", name="appreciation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $appreciations = $em->getRepository('AssistanceBundle:Appreciation')->findAll();

        return $this->render('@Assistance/appreciation/index.html.twig', array(
            'appreciations' => $appreciations,
        ));
    }

    /**
     * Creates a new appreciation entity.
     *
     * @Route("/new", name="appreciation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $appreciation = new Appreciation();
        $form = $this->createForm('AssistanceBundle\Form\AppreciationType', $appreciation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($appreciation);
            $em->flush();

            return $this->redirectToRoute('appreciation_show', array('id' => $appreciation->getId()));
        }

        return $this->render('@Assistance/appreciation/new.html.twig', array(
            'appreciation' => $appreciation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a appreciation entity.
     *
     * @Route("/{id}", name="appreciation_show")
     * @Method("GET")
     */
    public function showAction(Appreciation $appreciation)
    {
        $deleteForm = $this->createDeleteForm($appreciation);

        return $this->render('@Assistance/appreciation/show.html.twig', array(
            'appreciation' => $appreciation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing appreciation entity.
     *
     * @Route("/{id}/edit", name="appreciation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Appreciation $appreciation)
    {
        $deleteForm = $this->createDeleteForm($appreciation);
        $editForm = $this->createForm('AssistanceBundle\Form\AppreciationType', $appreciation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('appreciation_edit', array('id' => $appreciation->getId()));
        }

        return $this->render('@Assistance/appreciation/edit.html.twig', array(
            'appreciation' => $appreciation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a appreciation entity.
     *
     * @Route("/{id}/delete", name="appreciation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Appreciation $appreciation)
    {
        $form = $this->createDeleteForm($appreciation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($appreciation);
            $em->flush();
        }

        return $this->redirectToRoute('appreciation_index');
    }

    /**
     * Creates a form to delete a appreciation entity.
     *
     * @param Appreciation $appreciation The appreciation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Appreciation $appreciation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('appreciation_delete', array('id' => $appreciation->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Displays a form to edit an existing publication entity.
     *
     * @Route("/{id}/like", name="like_inc")
     * @Method({"GET", "POST"})
     */
    public function like_incAction(Request $request, $id, Publication $publication)
    {
        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository('AssistanceBundle:Appreciation')->findOneBy(array('publication' => $publication->getId(), 'user' => $this->getUser()));
        $pubnb=$em->getRepository('EvaluationBundle:Publication')->find($publication->getId());
        if (empty($a))
        {
            $app = new Appreciation();
            $app->setUser($this->getUser());
            $app->setPublication($publication);
            $app->setLikes(1);
            $app->setDislike(0);
            $pubnb->setNbLikes($pubnb->getNbLikes()+1);
            $em->persist($pubnb);
            $em->persist($app);
            $em->flush();
        } else {
                  if ($a->getDislike()==1)
                     {
                       $a->setLikes(1);
                       $a->setDislike(0);
                       $pubnb->setNbLikes($pubnb->getNbLikes()+1);
                       $pubnb->setNbDisLikes($pubnb->getNbDisLikes()-1);
                       $em->persist($pubnb);
                       $em->persist($a);
                       $em->flush();
                     } else {
                          $em->remove($a);
                          $pubnb->setNbLikes($pubnb->getNbLikes()-1);
                           $em->persist($pubnb);
                           $em->flush();
                            }}
        return $this->redirectToRoute('publication_index');
    }

    /**
     * Displays a form to edit an existing publication entity.
     *
     * @Route("/{id}/dislike", name="dislike_inc")
     * @Method({"GET", "POST"})
     */
    public function dislike_incAction(Request $request, Publication $publication)
    {
        $em = $this->getDoctrine()->getManager();
        $a = $em->getRepository('AssistanceBundle:Appreciation')->findOneBy(array('publication' => $publication->getId(), 'user' => $this->getUser()));
        $pubnb=$em->getRepository('EvaluationBundle:Publication')->find($publication->getId());
        if (empty($a)) {
            $app = new Appreciation();
            $app->setUser($this->getUser());
            $app->setPublication($publication);
            $app->setLikes(0);
            $app->setDislike(1);
            $pubnb->setNbDisLikes($pubnb->getNbLikes()+1);
            $em->persist($pubnb);
            $em = $this->getDoctrine()->getManager();
            $em->persist($app);
            $em->flush();
        } else {
                  if ($a->getLikes()==1)
                     {   $a->setLikes(0);
                     $a->setDislike(1);
                     $pubnb->setNbLikes($pubnb->getNbLikes()-1);
                     $pubnb->setNbDisLikes($pubnb->getNbDisLikes()+1);
                     $em->persist($pubnb);
                     $em->persist($a);
                     $em->flush();
                     } else {
                      $pubnb->setNbDisLikes($pubnb->getNbDisLikes()-1);
                     $em->persist($pubnb);
                      $em->remove($a);
                      $em->flush();}
        }
        return $this->redirectToRoute('publication_index');
    }

//    /**
//     *
//     * @Route("/{id}/likenb", name="likenb")
//    */
//    pub function nblikes($publication)
//    {
//
//        $em = $this->getDoctrine()->getManager();
//        $a = $em->getRepository('AssistanceBundle:Appreciation')->findOneBy(array('publication' => $publication->getId()));
//        $a->getLikes();
//        return $a->getLikes();
//
//    }
//
//    pub function nbdislikes($publication)
//    {
//
//        $em = $this->getDoctrine()->getManager();
//        $a = $em->getRepository('AssistanceBundle:Appreciation')->findOneBy(array('publication' => $publication->getId()));
//        $a->getLikes();
//        return $a->getLikes();
//
//    }
}