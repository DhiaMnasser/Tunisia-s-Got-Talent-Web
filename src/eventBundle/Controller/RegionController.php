<?php

namespace eventBundle\Controller;

use eventBundle\Entity\Region;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Region controller.
 *
 * @Route("region")
 */
class RegionController extends Controller
{
    /**
     * Lists all region entities.
     *
     * @Route("/", name="region_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $regions = $em->getRepository('eventBundle:Region')->findAll();






        $pagination  = $this->get('knp_paginator')->paginate(
            $regions,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            5/*nbre d'éléments par page*/  );
        return $this->render('@event/region/index.html.twig', array("regions"=>$pagination));
    }

    /**
     * Creates a new region entity.
     *
     * @Route("/new", name="region_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $region = new Region();
        $form = $this->createForm('eventBundle\Form\RegionType', $region);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($region->getNbVilles()<0)
            {
                return $this->render('@event/region/new.html.twig', array(
                    'region' => $region,
                    'form' => $form->createView(),
                ));
            }
            else
            $em = $this->getDoctrine()->getManager();
            $em->persist($region);
            $em->flush();

            return $this->redirectToRoute('region_show', array('id' => $region->getId()));
        }

        return $this->render('@event/region/new.html.twig', array(
            'region' => $region,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a region entity.
     *
     * @Route("/{id}", name="region_show")
     * @Method("GET")
     */
    public function showAction(Region $region)
    {
        $deleteForm = $this->createDeleteForm($region);

        return $this->render('@event/region/show.html.twig', array(
            'region' => $region,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing region entity.
     *
     * @Route("/{id}/edit", name="region_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Region $region)
    {
        $deleteForm = $this->createDeleteForm($region);
        $editForm = $this->createForm('eventBundle\Form\RegionType', $region);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('region_edit', array('id' => $region->getId()));
        }

        return $this->render('@event/region/edit.html.twig', array(
            'region' => $region,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a region entity.
     *
     * @Route("/{id}/delete", name="region_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Region $region)
    {
        $form = $this->createDeleteForm($region);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($region);
            $em->flush();
        }

        return $this->redirectToRoute('region_index');
    }

    /**
     * Creates a form to delete a region entity.
     *
     * @param Region $region The region entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Region $region)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('region_delete', array('id' => $region->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function search2Action(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('p');
        $posts =  $em->getRepository('eventBundle:Region')->findEntitiesByString($requestString);
        if(!$posts) {
            $result['posts']['error'] = "Pas de résultats trouvés :( ";
        } else {
            $result['posts'] = $this->getRealEntities($posts);
        }
        return new Response(json_encode($result));
    }

    public function getRealEntities($posts){
        foreach ($posts as $posts){
            $realEntities[$posts->getId()] = [$posts->getNom()];

        }
        return $realEntities;
    }


}
