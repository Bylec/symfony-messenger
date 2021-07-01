<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends AbstractFOSRestController
{

    /**
     * @Rest\Post("/products")
     * @param Request $request
     */
    public function saveProduct(Request $request)
    {
        return $request->headers;
    }

    /**
     * @Rest\Get("/products")
     */
    public function allProducts()
    {
        return "hello";
    }
}