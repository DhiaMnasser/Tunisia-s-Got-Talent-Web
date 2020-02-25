<?php


namespace TgtBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TgtBundle\Entity\Region;
use TgtBundle\Form\RegionType;

class RegionController extends Controller
{
    public function addAction(Request $request)
    {
        $region=new Region();
        $form=$this->createForm(RegionType::class,$region);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($region);
            $em->flush();

            return $this->redirectToRoute('region_list');
        }
        return $this->render('@Tgt\Region\create.html.twig',array('form'=>$form->createView()));
    }
    public function listAction()
    {
        $rep=$this->getDoctrine()->getManager()->getRepository(Region::class);
        $regions=$rep->findAll();

        return $this->render("@Tgt\Region\list.html.twig",array('regions'=>$regions));
    }

    public function updateAction(Request $request,$id)
    {
        $region=$this->getDoctrine()->getManager()
            ->getRepository(Region::class)->find($id);
        $form=$this->createForm(RegionType::class,$region);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em=$this->getDoctrine()->getManager();
            $em->persist($region);
            $em->flush();

            return $this->redirectToRoute('region_list');
        }

        return $this->render('@Tgt\Region\create.html.twig',array('form'=>$form->createView()));
    }

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $repository=$em->getRepository(Region::class);
        $region=$repository->find($id);
        $em->remove($region);
        $em->flush();

        return $this->redirectToRoute('region_list');

    }
}