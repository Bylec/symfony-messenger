<?php

namespace App\MessageHandler;

use App\Entity\Product;
use App\Message\CreateProductMessage;
use App\Repository\ProductRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class CreateProductMessageHandler implements MessageHandlerInterface
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(CreateProductMessage $productMessage): void
    {
        $product = new Product();
        $product->setName($productMessage->getName());
        $this->productRepository->save($product);
    }
}