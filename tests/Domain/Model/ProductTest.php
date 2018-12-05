<?php

namespace App\Tests\Domain\Model;

use App\Domain\Model\Product;
use App\Domain\ValueObject\Money;
use App\Domain\ValueObject\Vat;
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
     *
     * @throws \App\Domain\Exceptions\MoneyException
     * @throws \App\Domain\Exceptions\VatException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function createProductTest()
    {
        $kernel = self::bootKernel();

        /** @var \Doctrine\ORM\EntityManager $em */
        $em = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();


        $testData = [
            'barcode' => (string) rand(1, 10000),
            'name' => 'product',
            'cost' => '9.99',
            'vat' => 6
        ];

        $product = new Product();
        $product->setBarcode($testData['barcode']);
        $product->setName($testData['name']);
        $product->setCost(new Money($testData['cost']));
        $product->setVat(new Vat($testData['vat']));

        $product->setUpdatedAt(new \DateTime('now'));
        $em->persist($product);
        $em->flush();

        $this->assertTrue(is_integer($product->getId()));

        $this->assertEquals($testData, [
            'barcode' => $product->getBarcode(),
            'name' => $product->getName(),
            'cost' => $product->getCost(),
            'vat' => $product->getVat()->getValue()
        ]);

        var_dump($product->getUpdatedAt());
        var_dump($product->getCreatedAt());
    }
}