<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/ajouter-produit', name: 'product_create', methods: 'GET|HEAD')]
    public function create(): Response
    {
        return $this->render('product/create.html.twig');
    }

    #[Route('/ajouter-produit', name: 'product_persist', methods: 'POST')]
    public function persist(Request $request, ProductRepository $productRepository): Response
    {
        $name = $request->request->get('name');
        $description = $request->request->get('description');
        $price = $request->request->filter('price', FILTER_VALIDATE_FLOAT);

        $product = new Product();
        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice($price);

        $productRepository->add($product);
        return $this->render('product/create.html.twig');
    }
}
