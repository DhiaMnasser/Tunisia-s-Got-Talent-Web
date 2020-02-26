<?php

namespace eventBundle\Controller;

use Doctrine\ORM\Mapping\Entity;
use eventBundle\Entity\Evenement;
use eventBundle\Entity\Region;
use eventBundle\Entity\User;
use eventBundle\Repository\EvenementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Evenement controller.
 *
 * @Route("evenement")
 */
class EvenementController extends Controller
{
    /**
     * Lists all evenement entities.
     *
     * @Route("/", name="evenement_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $em2 = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository('eventBundle:Evenement')->findAll();
        $regions = $em2->getRepository('eventBundle:Region')->findAll();

        return $this->render('@event/evenement/index.html.twig', array('evenements' => $evenements , 'regions' => $regions ));
    }

    /**
     * Lists all evenement entities.
     *
     * @Route("/admin", name="evenement_indexadmin")
     * @Method("GET")
     */
    public function indexAdminAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $evenements = $em->getRepository('eventBundle:Evenement')->findAll();

        $pagination  = $this->get('knp_paginator')->paginate(
            $evenements,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            2/*nbre d'éléments par page*/  );
        return $this->render('@event/evenement/indexadmin.html.twig', array("evenements"=>$pagination));
    }


    /**
     * Creates a new evenement entity.
     *
     * @Route("/new", name="evenement_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $evenement = new Evenement();
        $form = $this->createForm('eventBundle\Form\EvenementType', $evenement);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

if($evenement->getDateD()>=$evenement->getDateF() || $evenement->getDuree()<0 || $evenement->getMaxParticipants()<0 ||
$evenement->getEtat() <0 || $evenement->getEtat() >1)
{

    return $this->render('@event/evenement/new.html.twig', array(
        'evenement' => $evenement,
        'form' => $form->createView(),
    ));
}
    else



            $em = $this->getDoctrine()->getManager();
            $em->persist($evenement);
            $em->flush();

            return $this->redirectToRoute('evenement_showadmin', array('id' => $evenement->getId()));

        }

        return $this->render('@event/evenement/new.html.twig', array(
            'evenement' => $evenement,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a evenement entity.
     *
     * @Route("/admin/{id}", name="evenement_show")
     * @Method("GET")
     */
    public function showAction(Evenement $evenement )
    {


        $deleteForm = $this->createDeleteForm($evenement);

        return $this->render('@event/evenement/show.html.twig', array(
            'evenement' => $evenement,
            'delete_form' => $deleteForm->createView()

        ));
    }
    /**
     * Finds and displays a evenement entity.
     *
     * @Route("/{id}", name="evenement_showadmin")
     * @Method("GET")
     */
    public function showadminAction(Evenement $evenement)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('eventBundle:Evenement')->tableauuser();
        $deleteForm = $this->createDeleteForm($evenement);

        return $this->render('@event/evenement/showadmin.html.twig', array(
            'evenement' => $evenement,'users' => $users ,
            'delete_form' => $deleteForm->createView()
        ));
    }

    /**
     * Displays a form to edit an existing evenement entity.
     *
     * @Route("/{id}/edit", name="evenement_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Evenement $evenement)
    {
        $deleteForm = $this->createDeleteForm($evenement);
        $editForm = $this->createForm('eventBundle\Form\EvenementType', $evenement);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if($evenement->getDateD()>=$evenement->getDateF() || $evenement->getDuree()<0 || $evenement->getMaxParticipants()<0 ||
                $evenement->getEtat() <0 || $evenement->getEtat() >1)
            {
                return $this->render('@event/evenement/edit.html.twig', array(
                    'evenement' => $evenement,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                ));
            }
            else

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('evenement_indexadmin', array('id' => $evenement->getId()));
        }

        return $this->render('@event/evenement/edit.html.twig', array(
            'evenement' => $evenement,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a evenement entity.
     *
     * @Route("/admin/{id}/delete", name="evenement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Evenement $evenement)
    {
        $form = $this->createDeleteForm($evenement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($evenement);
            $em->flush();
        }

        return $this->redirectToRoute('evenement_indexadmin');
    }

    /**
     * Creates a form to delete a evenement entity.
     *
     * @param Evenement $evenement The evenement entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Evenement $evenement)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evenement_delete', array('id' => $evenement->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    /**
     * Lists all evenement entities.
     *
     * @Route("/{id}/imp", name="evenement_imp")
     * @Method("GET")
     */
    public function indeximpAction(Evenement $evenement)
    {
        $deleteForm = $this->createDeleteForm($evenement);
        return $this->render('@event\evenement\imp.html.twig',array(
        'evenement' => $evenement,
        'delete_form' => $deleteForm->createView(),
    ));
    }


    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('p');
        $posts =  $em->getRepository('eventBundle:Evenement')->findEntitiesByString($requestString);
        if(!$posts) {
            $result['posts']['error'] = "Pas de résultats trouvés :( ";
        } else {
            $result['posts'] = $this->getRealEntities($posts);
        }
        return new Response(json_encode($result));
    }

    public function getRealEntities($posts){
        foreach ($posts as $posts){
            $realEntities[$posts->getId()] = [$posts->getNomevent()];

        }
        return $realEntities;
    }
    public function filterevenementAction(Request $request)
    {
        $str = $request->get('str');
        $em = $this->getDoctrine()->getManager();
        $evenement = $em->getRepository("EntityBundle:Evenement")
            ->filtreregion($str);
        return $this->render("@event/evenement/index.html.twig", array(
            "evenements" => $evenement,

        ));
    }

    /**
     * Lists all evenement entities.
     *
     * @Route("/evenement/submit", name="evenement_submit")
     * @Method("GET")
     */
    public function submitAction()
    {


        $test = $this->getUser() ;
        $em = $this->getDoctrine()->getManager();
         $em->getRepository('eventBundle:Evenement')->eventset($test);

        return $this->redirectToRoute('evenement_index');
        /*$this->getUser()->getId() ;*/


    }
}
