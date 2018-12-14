<?php

namespace App\Tests\Domain\Service;

use App\Domain\DataMapper\ReceiptToResourceMapper;
use App\Domain\Entity\Product;
use App\Domain\Entity\Receipt;
use App\Domain\Factory\ProductFactory;
use App\Domain\Factory\ReceiptFactory;
use App\Domain\Factory\SelectedProductFactory;
use App\Domain\Request\AddProductToReceiptRequest;
use App\Domain\Request\BarcodeRequest;
use App\Domain\Request\CreateProductRequest;
use App\Domain\Request\FinishReceiptRequest;
use App\Domain\Request\ProductsListRequest;
use App\Domain\Request\ReceiptLastProductAmountUpdateRequest;
use App\Domain\Request\ReceiptRequest;
use App\Domain\Service\Service;
use App\Persistence\Repository\ProductRepository;
use App\Persistence\Repository\ReceiptRepository;
use App\Persistence\Repository\SelectedProductRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

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
            new ProductFactory(),
            new ReceiptFactory(),
            new SelectedProductFactory()
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
        $request = new ProductsListRequest(['barcode' => 'desc'], 2, null);
        /** @var Product[] $list */
        $list = $this->service->getProductsList($request);

        $this->assertCount(2, $list);
        $this->assertGreaterThan(
            $list[1]->getBarcode(),
            $list[0]->getBarcode()
        );
    }

    /**
     * @test
     */
    public function createReceipt()
    {
        $receipt = $this->service->createReceipt();
        $this->assertInstanceOf(Receipt::class, $receipt);
        $this->assertInternalType('integer', $receipt->getId());
    }

    /**
     * @test
     */
    public function addProductToReceiptPositive()
    {
        $request = new AddProductToReceiptRequest(37, '123', 1);
        $this->service->addProductToReceipt($request);

        $this->assertNull(null);
    }

    /**
     * @test
     */
    public function addProductToReceiptNegative()
    {
        $request = new AddProductToReceiptRequest('asdasdd', 123123, 0);
        $this->service->addProductToReceipt($request);

        $this->assertNull(null);
    }

    /**
     * @test
     */
    public function receiptLastProductAmountUpdate()
    {
        $request = new ReceiptLastProductAmountUpdateRequest(46, 33);
        $this->service->receiptLastProductAmountUpdate($request);

        $this->assertNull(null);
    }

    /**
     * @test
     */
    public function finishReceipt()
    {
        $request = new FinishReceiptRequest(46);
        $this->service->finishReceipt($request);
    }

    /**
     * @test
     */
    public function getReceiptReport()
    {
        $request = new ReceiptRequest(37);
        $receipt = $this->service->getReceiptReport($request);
        $this->assertNotNull($receipt);

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $serializedReceipt = $serializer->serialize($receipt, 'json');

        $this->assertJson($serializedReceipt);
    }
}
