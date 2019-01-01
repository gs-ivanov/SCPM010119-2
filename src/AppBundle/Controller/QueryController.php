<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class QueryController extends Controller
{
    /**
     * @Route("/sortasc",name="sort_asc")
     */
    public function findAllByNameProductActionASC()
    {
        $em=$this->getDoctrine()->getManager();
        $products=$em->getRepository('AppBundle:Product')->findAllOrderedByNameASC();
        if (!$products){
            throw $this->createNotFoundException('No product found for id ');
        }
        return $this->render('default/index.html.twig',[
            'products' => $products]);
//        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/sortdesc",name="sort_desc")
     */
    public function findAllByNameProductActionDESC()
    {
        $em=$this->getDoctrine()->getManager();
        $products=$em->getRepository('AppBundle:Product')->findAllOrderedByNameDESC();
        if (!$products){
            throw $this->createNotFoundException('No product found for id ');
        }
        return $this->render('default/index.html.twig',[
            'products' => $products]);
    }

    /**
     * @Route("/sortpricedesc",name="sortpricedesc")
     */
    public function findAllByPriceProductActionDESC()
    {
        $em=$this->getDoctrine()->getManager();
        $products=$em->getRepository('AppBundle:Product')->findAllOrderedByPriceDESC();
        if (!$products){
            throw $this->createNotFoundException('No product found for id ');
        }
        return $this->render('default/index.html.twig',[
            'products' => $products]);
    }

    /**
     * @Route("/sortpriceasc",name="sortpriceasc")
     */
    public function findAllByPriceProductActionASC()
    {
        $em=$this->getDoctrine()->getManager();
        $products=$em->getRepository('AppBundle:Product')->findAllOrderedByPriceASC();
        if (!$products){
            throw $this->createNotFoundException('No product found for id ');
        }
        return $this->render('default/index.html.twig',[
            'products' => $products]);
    }
}
