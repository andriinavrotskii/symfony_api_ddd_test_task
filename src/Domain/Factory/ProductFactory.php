<?php

namespace App\Domain\Factory;

use App\Domain\Model\Product;
use App\Domain\Request\CreateProductRequest;
use App\Domain\ValueObject\Money;
use App\Domain\ValueObject\Vat;

class ProductFactory
{
    /**
     * @param CreateProductRequest $request
     * @return Product
     * @throws \App\Domain\Exceptions\MoneyException
     * @throws \App\Domain\Exceptions\VatException
     */
    public function createProduct(CreateProductRequest $request)
    {
        $product = new Product();
        $product->setBarcode($request->getBarcode());
        $product->setName($request->getName());
        $product->setCost(new Money($request->getCost()));
        $product->setVat(new Vat($request->getVat()));

        return $product;
    }
}