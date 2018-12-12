<?php

namespace App\Domain\DataMapper;

use App\Domain\Entity\Receipt;
use App\Domain\Entity\SelectedProduct;
use App\Domain\Exceptions\StatusException;
use App\Domain\Resource\ReceiptResource;
use App\Domain\Resource\SelectedProductResource;
use App\Domain\ValueObject\Money;
use Doctrine\Common\Collections\Collection;

class ReceiptToResourceMapper
{
    /** @var array */
    private $selectedProducts;

    /** @var int */
    private $totalAmount;

    /** @var Money */
    private $totalCost;

    /**
     * ReceiptToResourceMapper constructor.
     * @throws \App\Domain\Exceptions\MoneyException
     */
    public function __construct()
    {
        $this->selectedProducts = [];
        $this->totalAmount = 0;
        $this->totalCost = new Money(0);
    }

    /**
     * @param Receipt $receipt
     * @return ReceiptResource
     * @throws StatusException
     * @throws \App\Domain\Exceptions\MoneyException
     */
    public function map(Receipt $receipt)
    {
        $this->prepareSelectedProducts($receipt->getSelectedProducts());

        return new ReceiptResource(
            $receipt->getId(),
            $this->getTextStatus($receipt),
            $this->selectedProducts,
            $this->totalAmount,
            $this->totalCost->__toString()
        );
    }

    /**
     * @param Collection $selectedProducts
     * @throws \App\Domain\Exceptions\MoneyException
     */
    private function prepareSelectedProducts(Collection $selectedProducts)
    {
        /** @var SelectedProduct $selectedProduct */
        foreach ($selectedProducts as $selectedProduct) {
            $selectedProductTotalCost = $selectedProduct->getCost()->multiplicateOn($selectedProduct->getAmount());
            $this->totalAmount += $selectedProduct->getAmount();
            $this->totalCost = $this->totalCost->increaseBy($selectedProductTotalCost);

            $this->selectedProducts[] = new SelectedProductResource(
                $selectedProduct->getId(),
                $selectedProduct->getProduct()->getBarcode(),
                $selectedProduct->getProduct()->getName(),
                $selectedProduct->getAmount(),
                $selectedProduct->getCost()->__toString(),
                $selectedProductTotalCost->__toString()
            );
        }
    }

    /**
     * @param Receipt $receipt
     * @return string
     * @throws StatusException
     */
    public function getTextStatus(Receipt $receipt)
    {
        switch ($receipt->getStatus()) {
            case Receipt::STATUS_FINISHED:
                return 'finished';
                break;
            case Receipt::STATUS_NEW:
                return 'new';
                break;
            default:
                throw new StatusException('You forget add new status to ReceiptToResourceMapper');
        }
    }
}