<?php

namespace App\Tests;

use App\Entity\Product;
use App\Message\CreateProductMessage;
use App\Message\UpdateProductMessage;
use App\MessageHandler\CreateProductMessageHandler;
use App\MessageHandler\UpdateProductMessageHandler;
use App\Repository\ProductRepository;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testDispatchCreateProductMessageCreatesProduct(): void
    {
        $productRepository = $this->getMockBuilder(ProductRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $message = new CreateProductMessage("this is test string");

        $productRepository->expects(self::exactly(1))
            ->method('save')
            ->with(
                self::isInstanceOf(Product::class)
            );

        $handler = new CreateProductMessageHandler($productRepository);
        $handler($message);
    }

    public function testDispatchUpdateProductMessageUpdatesProduct(): void
    {
        $product = $this->getMockBuilder(Product::class)
            ->disableOriginalConstructor()
            ->getMock();

        $productRepository = $this->createStub(ProductRepository::class);
        $productRepository->method('find')
            ->willReturn($product);

        $message = new UpdateProductMessage(1, "this is test string");

        $productRepository->expects(self::exactly(1))
            ->method('save')
            ->with(
                self::isInstanceOf(Product::class)
            );

        $handler = new UpdateProductMessageHandler($productRepository);
        $handler($message);
    }
}
