<?php

namespace App\Domain\Service;

use App\Domain\Model\Product;
use App\Domain\Model\Receipt;
use App\Domain\Repository\ProductRepositoryInterface;

class ReceiptService
{
    public function __construct(ProductRepositoryInterface $productRepository)
    {

    }

    public function addProductToReceipt(Receipt $receipt, Product $product)
    {
        $receipt->getSelectedProducts();
    }
}