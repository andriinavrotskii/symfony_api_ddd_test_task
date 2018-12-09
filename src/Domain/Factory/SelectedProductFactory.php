<?php

namespace App\Domain\Factory;

use App\Domain\Entity\ProductInterface;
use App\Domain\Entity\ReceiptInterface;
use App\Domain\Entity\SelectedProduct;

class SelectedProductFactory
{
    public function create(ReceiptInterface $receipt, ProductInterface $product, int $amount)
    {
        $selectedProduct = new SelectedProduct();
        $selectedProduct->setReceipt($receipt);
        $selectedProduct->setProduct($product);
        $selectedProduct->setAmount($amount);

        return $selectedProduct;
    }
}