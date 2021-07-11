<?php
declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\UpdateProductMessage;
use App\Repository\ProductRepository;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class UpdateProductMessageHandler implements MessageHandlerInterface
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(UpdateProductMessage $productMessage): void
    {
        $product = $this->productRepository->find($productMessage->getId());
        if ($product) {
            $product->setName($productMessage->getName());
            $this->productRepository->save($product);
        }
    }
}