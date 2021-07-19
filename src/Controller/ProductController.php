<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;

class ProductController extends AbstractController{
    
    /**
     * @Route("/", name="home_page", methods={"GET"})
     */
    public function index(): Response {
        
        $products=$this->getDoctrine()->getRepository(Product::class)->findAll();

        return $this->render('index.html.twig', ['products'=>$products]);
    }

    /**
     * @Route("/tuotteet", name="products_list", methods={"GET"})
     */
    public function list(): Response {
        
        $products=$this->getDoctrine()->getRepository(Product::class)->findAll();

        return $this->render('products.html.twig', ['products'=>$products]);
    }

    /**
     * @Route("/{url}", name="product_details", methods={"GET"})
     */
    public function details(string $url): Response {
        $product=$this->getDoctrine()->getRepository(Product::class)->findOneBy(['url'=>$url]);

        return $this->render('product.html.twig', ['product'=>$product]);
    }

    /**
     * @Route("/api/products/{url}", name="api.product_details", methods={"GET"})
     */
    public function productDetails(string $url): Response {
        $product=$this->getDoctrine()->getRepository(Product::class)->findOneBy(['url'=>$url]);

        $product_details=array('url'=>$product->getUrl(), 'price'=> $product->getPrice(), 'inStore' => $product->getInStore(), 'stock' => $product->getStock(), 'features'=>$product->getFeatures());

        return $this->json($product_details);
    }

    /**
     * @Route("/api/products", name="api.product_list", methods={"GET"})
     */
    public function productsDetails(): Response {
        $products=$this->getDoctrine()->getRepository(Product::class)->findAll();

        $products_details=[];
        foreach($products as $product){
            $products_details[]=['url'=>$product->getUrl(), 'price'=> $product->getPrice(), 'vat'=>$product->getVat(), 'inStore' => $product->getInStore(), 'stock' => $product->getStock(), 'features'=>$product->getFeatures()];
        }

        return $this->json($products_details);
    }
}