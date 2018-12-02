<?php

namespace App\Tests\Domain\Model;

use App\Domain\Model\Money;
use App\Domain\Model\Product;
use App\Domain\Model\Vat;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ProductTest extends KernelTestCase
{
    /**
     * @test
     */
    public function positiveTest()
    {
        $testData = [
            'id' => 1,
            'barcode' => '1234',
            'name' => 'product',
            'cost' => '9.99',
            'vat' => 21
        ];
        $product = new Product();
        $product->setId($testData['id']);
        $product->setBarcode($testData['barcode']);
        $product->setName($testData['name']);
        $product->setCost(new Money($testData['cost']));
        $product->setVat(new Vat($testData['vat']));

        $this->assertEquals($testData, [
            'id' => $product->getId(),
            'barcode' => $product->getBarcode(),
            'name' => $product->getName(),
            'cost' => $product->getCost(),
            'vat' => $product->getVat()->getValue()
        ]);
    }

    /**
     * @test
     */
    public function createProductTest()
    {
        $kernel = self::bootKernel();

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();


        $testData = [
            'barcode' => '1234',
            'name' => 'product',
            'cost' => '9.99',
            'vat' => 21
        ];

        $product = new Product();
        $product->setBarcode($testData['barcode']);
        $product->setName($testData['name']);
        $product->setCost(new Money($testData['cost']));
        $product->setVat(new Vat($testData['vat']));
//var_dump($product);
//        $em->persist($product);
//        $em->flush();
    }
}