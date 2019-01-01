<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CRUDController extends Controller
{
    /**
     * @Route("/new",name="new")
     */
    public function newProduct(Request $request)
    {
        $product=new Product();
        $form=$this->createForm(ProductType::class,$product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em  =$this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render('default/edit.html.twig',['form'=>$form->createView()]);
    }


    /**
     * @Route("/create")
     */
    public function createProductAction()
    {
        //Creating new product
        $product=new Product();
        $product->setName('Acer E1-531');
        $product->setPrice(400.25);
        $product->setDescription('Good choics Intel 1000M/8GB RAM/1TB HDD');
//        var_dump($product);exit();
        $em=$this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return new Response('Id is: '.$product->getId());
    }

    /**
     * @Route("/show/{id}")
     */
    public function showProductAction($id)
    {
        //show existing product by id
//        $product=$this->getDoctrine()->getRepository('AppBundle:Product')->find($id);
        $repository=$this->getDoctrine()->getRepository('AppBundle:Product');
        $product=$repository->find($id);
//    $productPrc=$repository->findByNmae();
//    $productPrc=$repository->findByPrice();
//    $productAll=$repository->findAll();

        //        var_dump($product);exit();
        if (!$product){
            throw $this->createNotFoundException('No product found for id '.$id);
        }

        $name=$product->getName();
        $price=$product->getPrice();
        $decription=$product->getDescription();


        return new Response("<html><body><h1>Name: $name</h1>
                                    <h2>Price: $price USD</h2>
                                    <hr><p>$decription</p></body></html>");
    }


    /**
     * @Route("/edit/{id}",name="edit")
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function editProduct(Request $request,int $id)
    {
        $product=$this->getDoctrine()->getRepository(Product::class)->find($id);
        $form=$this->createForm(ProductType::class,$product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em  =$this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render('default/edit.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Route("/delete/{id}",name="delete")
     */
    public function deleteProductAction($id)
    {
        $repository=$this->getDoctrine()
            ->getRepository('AppBundle:Product');
//        $product=$repository->findDescriptionText($id);
        $product=$repository->find($id);
//        dump($product);exit;

        return $this->render('default/confirm.html.twig',[
            'products' => $product,]);

    }

    /**
     * @Route("/confirmdelete/{id}",name="confirmdelete")
     * @param $product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function executeAction($id)
    {
        //delete existing product by id
        $repository=$this->getDoctrine()
            ->getRepository('AppBundle:Product');
        $product=$repository->find($id);
        if (!$product){
            throw $this->createNotFoundException('No product found for id '.$id);
        }
//        return $this->render('default/confirm.html.twig',[
//            'products' => $product]);

        $em=$this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/details/{id}",name="details")
     */
    public function showProductDetailsAction(int $id)
    {
        $repository=$this->getDoctrine()
            ->getRepository('AppBundle:Product');
        $product=$repository->findDescriptionText($id);
        if (!$product){
            throw $this->createNotFoundException('No product found for id '.$id);
        }
        return $this->render('default/details.html.twig',[
            'products' => $product]);
    }
}
