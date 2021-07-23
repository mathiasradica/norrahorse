<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Product;
use App\Entity\Cart;
use App\Storage\CartSessionStorage;
use App\Factory\CartItemFactory;

class ProductController extends AbstractController{
    
    private $_cartSessionStorage;
    private $_cartItemFactory;

    public function __construct(CartSessionStorage $cartSessionStorage, CartItemFactory $cartItemFactory){
        $this->_cartSessionStorage = $cartSessionStorage;
        $this->_cartItemFactory = $cartItemFactory;
    }

    /**
     * @Route("/", name="home_page", methods={"GET"})
     */
    public function index(): Response {
        
        $products=$this->getDoctrine()->getRepository(Product::class)->findAll();
        $cart=$this->_cartSessionStorage->getCart();

        return $this->render('product/index.html.twig', ['products'=>$products]);
    }

    /**
     * @Route("/tuotteet", name="product_list", methods={"GET"})
     */
    public function list(): Response {
        
        $products=$this->getDoctrine()->getRepository(Product::class)->findAll();
        $cart=$this->_cartSessionStorage->getCart();
        
        return $this->render('product/products.html.twig', ['products'=>$products]);
    }

    /**
     * @Route("/{url}", name="product_details", methods={"GET"})
     */
    public function details(string $url): Response {
        $product=$this->getDoctrine()->getRepository(Product::class)->findOneBy(['url'=>$url]);
        $cart=$this->_cartSessionStorage->getCart();

        return $this->render('product/product.html.twig', ['product'=>$product]);
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

    /**
     * @Route("/api/add", name="api.add_product_to_cart", methods={"POST"})
     */
    public function addToCart(Request $request): Response {
        $product=$this->getDoctrine()->getRepository(Product::class)->findOneBy(['url'=>$request->get('product')]);
        $quantity=$request->get('quantity');
        $cartItem=$this->_cartItemFactory->createItem($product, $quantity);
        $cart=$this->_cartSessionStorage->getCart();
        $cart->addItem($cartItem);
        $this->_cartSessionStorage->setCart($cart);

        return $this->json($cart);
    }
}