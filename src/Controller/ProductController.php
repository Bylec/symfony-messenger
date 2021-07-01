<?php
declare(strict_types = 1);

namespace App\Controller;

use App\Entity\Product;
use App\Message\CreateProductMessage;
use App\Message\UpdateProductMessage;
use App\Repository\ProductRepository;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Serializer\JMSSerializerAdapter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class ProductController extends AbstractFOSRestController
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @Rest\Get("/products/{productId}")
     */
    public function getProduct(int $productId): Product
    {
        return $this->productRepository->find($productId);
    }

    /**
     * @Rest\Get("/products")
     */
    public function allProducts(): ?array
    {
        return $this->productRepository->findAll();
    }

    /**
     * @Rest\Post("/products")
     * @param Request $request
     */
    public function createProduct(Request $request, MessageBusInterface $messageBus): void
    {
        $messageBus->dispatch(new CreateProductMessage($request->get('name')));
    }

    /**
     * @Rest\Patch("/products/{productId}")
     * @param Request $request
     */
    public function updateProduct(Request $request, MessageBusInterface $messageBus, int $productId): void
    {
        $messageBus->dispatch(new UpdateProductMessage($productId, $request->get('name')));
    }
}