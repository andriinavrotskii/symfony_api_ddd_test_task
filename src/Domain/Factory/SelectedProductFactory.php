<?php

namespace App\Domain\Factory;

use App\Domain\Entity\Product;
use App\Domain\Entity\Receipt;
use App\Domain\Entity\SelectedProduct;

class SelectedProductFactory
{
    public function create(Receipt $receipt, Product $product, int $amount)
    {
        $selectedProduct = new SelectedProduct();
        $selectedProduct->setReceipt($receipt);
        $selectedProduct->setProduct($product);
        $selectedProduct->setAmount($amount);

        return $selectedProduct;
    }
}