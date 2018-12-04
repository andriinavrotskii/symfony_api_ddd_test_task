<?php

namespace App\Tests\Domain\Model;

use App\Domain\Model\Product;
use App\Domain\Model\Receipt;
use App\Domain\Model\SelectedProduct;
use PHPUnit\Framework\TestCase;

class ReceiptTest extends TestCase
{
    /** @var Receipt */
    private $receipt;

    protected function setUp()
    {
        $this->receipt = new Receipt();
        $this->receipt->setId(1);
        $this->receipt->getSelectedProducts()->add($this->createMock(SelectedProduct::class));
        $this->receipt->getSelectedProducts()->add($this->createMock(SelectedProduct::class));
        $this->receipt->getSelectedProducts()->add($this->createMock(SelectedProduct::class));
    }

    /**
     * @test
     */
    public function receiptCreated()
    {
        $this->assertInstanceOf(Receipt::class, $this->receipt);
        $this->assertEquals(1, $this->receipt->getId());
        $this->assertCount(3, $this->receipt->getSelectedProducts());
        $this->assertEquals(Receipt::STATUS_NEW, $this->receipt->getStatus());
    }

    /**
     * @test
     */
    public function addProductToReceipt()
    {
        $selectedProduct = new SelectedProduct();
        $selectedProduct->setId(999);
        $selectedProduct->setReceipt($this->receipt);
        $selectedProduct->setProduct($this->createMock(Product::class));

        $selectedProducts = $this->receipt->getSelectedProducts();
        $selectedProducts->add($selectedProduct);

        $this->receipt->setSelectedProducts($selectedProducts);
        $this->assertCount(4, $this->receipt->getSelectedProducts());


        $this->assertEquals(1, $this->receipt->getSelectedProducts()->last()->getAmount());
        $this->receipt->getSelectedProducts()->last()->setAmount(10);
        $this->assertEquals(10, $this->receipt->getSelectedProducts()->last()->getAmount());
    }

    /**
     * @test
     */
    public function finishReceipt()
    {
        $this->receipt->setStatus(Receipt::STATUS_FINISHED);
        $this->assertEquals(Receipt::STATUS_FINISHED, $this->receipt->getStatus());
    }
}
