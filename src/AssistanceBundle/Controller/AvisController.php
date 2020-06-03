<?php

namespace AssistanceBundle\Controller;

use AssistanceBundle\Entity\Avis;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Avi controller.
 *
 * @Route("avis")
 */
class AvisController extends Controller
{
    /**
     * Lists all avi entities.
     *
     * @Route("/consulter_avis", name="avis_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $avis = $em->getRepository('AssistanceBundle:Avis')->findBy(array(), array('date' => 'desc'));
        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator=$this->get('knp_paginator');
        $result =$paginator->paginate(
            $avis,
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 4));
        return $this->render('@Assistance/avis/index.html.twig', array(
            'avis' => $result,
        ));
    }

    /**
     * Creates a new avi entity.
     *
     * @Route("/envoyer_avis", name="avis_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $avi = new Avis();
        $avi->setDate(new \DateTime('now'));
        $avi->setUser($this->getUser());
        $form = $this->createForm('AssistanceBundle\Form\AvisType', $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($avi);
            $em->flush();

            return $this->redirectToRoute('avis_new');
        }

        return $this->render('@Assistance/avis/new.html.twig', array(
            'avi' => $avi,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a avi entity.
     *
     * @Route("/{id}", name="avis_show")
     * @Method("GET")
     */
    public function showAction(Avis $avi)
    {
        $deleteForm = $this->createDeleteForm($avi);

        return $this->render('@Assistance/avis/show.html.twig', array(
            'avi' => $avi,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing avi entity.
     *
     * @Route("/{id}/edit", name="avis_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Avis $avi)
    {
        $deleteForm = $this->createDeleteForm($avi);
        $editForm = $this->createForm('AssistanceBundle\Form\AvisType', $avi);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('avis_edit', array('id' => $avi->getId()));
        }

        return $this->render('@Assistance/avis/edit.html.twig', array(
            'avi' => $avi,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ligneCommande entity.
     *
     * @Route("/{id}/delete", name="avis_delete")
     * @Method("DELETE")
     */

    public function deleteAction($id)
    {{
        $em = $this->getDoctrine()->getManager();
        $avis = $em->getRepository("AssistanceBundle:Avis")->find($id);
        $avis=$this->getDoctrine()->getManager()->getRepository('AssistanceBundle:Avis')->find($avis->getId());
        $em->remove($avis);
        $em->flush();
        return $this->redirectToRoute('avis_index');
    }

       // return $this->redirectToRoute('avis_index');
    }

    /**
     * Creates a form to delete a avi entity.
     *
     * @param Avis $avi The avi entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Avis $avi)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('avis_delete', array('id' => $avi->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function newApiAction(Request $request)
    {
        $id= $request->query->get('user_id');
        $em=$this->getDoctrine()->getManager();
        $user=$this->getDoctrine()->getRepository('UserBundle:User')->find($id);
        $avi = new Avis();
        $avi->setUser($user);
        $avi->setDate(new \DateTime('now'));
        $text = $request->get('texte');
        $avi->setTexte($text);
        $em->persist($avi);
        $em->flush();

        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($avi);
        return new JsonResponse($formatted);

    }

    public function indexApiAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $avis = $em->getRepository('AssistanceBundle:Avis')->findAll();

        // $user = $em->getRepository("Proxies\\__CG__\\UserBundle\\Entity\\User")->find($request->get('user'));

        //     $commandes=$em->getRepository('AchatBundle:Commande')->findByUser_Id($user);

        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
        $encoder = new JsonEncoder();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $serializer = new Serializer(array($normalizer), array($encoder));
        $formatted = $serializer->normalize($avis);
        return new JsonResponse($formatted);
    }
}
