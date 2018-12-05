<?php

namespace App\Tests\Domain\Model;

use App\Domain\Model\Product;
use App\Domain\Model\Receipt;
use App\Domain\Model\SelectedProduct;
use App\Domain\ValueObject\Money;
use App\Domain\ValueObject\Vat;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ReceiptPersistenceTest extends KernelTestCase
{
    /** @var \Doctrine\ORM\EntityManager */
    private $em;

    public function setUp()/* The :void return type declaration that should be here would cause a BC issue */
    {
        $kernel = self::bootKernel();

        /** @var \Doctrine\ORM\EntityManager $em */
        $this->em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * @test
     */
    public function createReceiptTest()
    {
        $productData1 = [
            'barcode' => (string) rand(1, 10000),
            'name' => 'product1',
            'cost' => '9.99',
            'vat' => 6
        ];
        $product1 = new Product();
        $product1->setBarcode($productData1['barcode']);
        $product1->setName($productData1['name']);
        $product1->setCost(new Money($productData1['cost']));
        $product1->setVat(new Vat($productData1['vat']));


        $this->em->persist($product1);

        $productData2 = [
            'barcode' => (string) rand(1, 10000),
            'name' => 'product2',
            'cost' => '3.33',
            'vat' => 21
        ];
        $product2 = new Product();
        $product2->setBarcode($productData2['barcode']);
        $product2->setName($productData2['name']);
        $product2->setCost(new Money($productData2['cost']));
        $product2->setVat(new Vat($productData2['vat']));


        $this->em->persist($product2);

        $selectedProduct1 = new SelectedProduct();
        $selectedProduct1->setProduct($product1);
        $selectedProduct1->setAmount(11);

        $selectedProduct2 = new SelectedProduct();
        $selectedProduct2->setProduct($product2);
        $selectedProduct2->setAmount(22);


        $receipt = new Receipt();
        $receipt->addSelectedProduct($selectedProduct1);
        $receipt->addSelectedProduct($selectedProduct2);

        $this->em->persist($receipt);
        $this->em->flush();

        $this->assertEquals(2, $receipt->getSelectedProducts()->count());

        var_dump($receipt->getId());

        $this->em->remove($receipt);
        $this->em->flush();
    }

}
