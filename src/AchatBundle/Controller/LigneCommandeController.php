<?php

namespace AchatBundle\Controller;

use AchatBundle\Entity\LigneCommande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Lignecommande controller.
 *
 * @Route("lignecommande")
 */
class LigneCommandeController extends Controller
{
    /**
     * Lists all ligneCommande entities.
     *
     * @Route("/", name="lignecommande_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ligneCommandes = $em->getRepository('AchatBundle:LigneCommande')->findAll();

        return $this->render('@Achat/lignecommande/index.html.twig', array(
            'ligneCommandes' => $ligneCommandes,
        ));
    }

    /**
     * Creates a new ligneCommande entity.
     *
     * @Route("/new", name="lignecommande_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $ligneCommande = new Lignecommande();
        $form = $this->createForm('AchatBundle\Form\LigneCommandeType', $ligneCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ligneCommande);
            $em->flush();

            return $this->redirectToRoute('lignecommande_show', array('id' => $ligneCommande->getId()));
        }

        return $this->render('@Achat/lignecommande/new.html.twig', array(
            'ligneCommande' => $ligneCommande,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ligneCommande entity.
     *
     * @Route("/{id}", name="lignecommande_show")
     * @Method("GET")
     */
    public function showAction(LigneCommande $ligneCommande)
    {
        $deleteForm = $this->createDeleteForm($ligneCommande);

        return $this->render('@Achat/lignecommande/show.html.twig', array(
            'ligneCommande' => $ligneCommande,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ligneCommande entity.
     *
     * @Route("/{id}/edit", name="lignecommande_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, LigneCommande $ligneCommande)
    {
        $deleteForm = $this->createDeleteForm($ligneCommande);
        $editForm = $this->createForm('AchatBundle\Form\LigneCommandeType', $ligneCommande);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lignecommande_edit', array('id' => $ligneCommande->getId()));
        }

        return $this->render('@Achat/lignecommande/edit.html.twig', array(
            'ligneCommande' => $ligneCommande,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ligneCommande entity.
     *
     * @Route("/{id}/delete", name="lignecommande_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, LigneCommande $ligneCommande)
    {
        $form = $this->createDeleteForm($ligneCommande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ligneCommande);
            $em->flush();
        }

        return $this->redirectToRoute('lignecommande_index');
    }

    /**
     * Creates a form to delete a ligneCommande entity.
     *
     * @param LigneCommande $ligneCommande The ligneCommande entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(LigneCommande $ligneCommande)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lignecommande_delete', array('id' => $ligneCommande->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
