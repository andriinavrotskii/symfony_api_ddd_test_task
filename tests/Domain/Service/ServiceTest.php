<?php

namespace App\Tests\Domain\Service;

use App\Domain\Entity\ProductInterface;
use App\Domain\Factory\ProductFactory;
use App\Domain\Request\BarcodeRequest;
use App\Domain\Request\CreateProductRequest;
use App\Domain\Request\ProductsListRequest;
use App\Domain\Service\Service;
use App\Persistence\Repository\ProductRepository;
use App\Persistence\Repository\ReceiptRepository;
use App\Persistence\Repository\SelectedProductRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ServiceTest extends KernelTestCase
{
    /** @var Service */
    private $service;

    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $kernel = self::bootKernel();

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $this->service = new Service(
            new ProductRepository($em),
            new ReceiptRepository($em),
            new SelectedProductRepository($em),
            new ProductFactory()
        );
    }

    /**
     * @test
     */
    public function getReceiptsTest()
    {
        $result = $this->service->getReceipts();
        $this->assertNotNull($result);
    }

    /**
     * @test
     */
    public function createProductTest()
    {
        $barcode = (string) rand(1, 1000000);
        $productRequest = new CreateProductRequest(
            $barcode,
            'product name',
            '88.88',
            21
        );

        $product = $this->service->createProduct($productRequest);

        $returnedProduct = $this->service->getProductByBarcode(
            new BarcodeRequest($barcode)
        );

        $this->assertEquals(
            $product,
            $returnedProduct
        );
    }

    /**
     * @test
     */
    public function getProductsList()
    {
        $request = new ProductsListRequest(['barcode' => 'ASC'], 2, null);
        /** @var ProductInterface[] $list */
        $list = $this->service->getProductsList($request);

        $this->assertCount(3, $list);
        $this->assertGreaterThan($list[0]->getBarcode(), $list[1]->getBarcode());
    }


}
