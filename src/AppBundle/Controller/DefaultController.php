<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/products", name="products")
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $products=[1,2,3];
//        $products=$this->getDoctrine()
//            ->getRepository(Product::class)
//            ->getListWithCategories();
        return $this->render('default/index.html.twig',[
            'products' => $products]);
    }

    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return Response
     */
    public function showAllProductsAction(Request $request)
    {

        $products=$this->getDoctrine()
            ->getRepository(Product::class)
            ->getListWithCategories();
        return $this->render('default/products.html.twig',[
            'products' => $products]);
    }

}
