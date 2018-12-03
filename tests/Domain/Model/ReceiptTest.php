<?php

namespace App\Tests\Domain\Model;

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
        $this->receipt->getSelectedProducts()->add($this->createMock(SelectedProduct::class));
        $this->assertCount(4, $this->receipt->getSelectedProducts());
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
