<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Product;

interface ProductRepositoryInterface extends AbstractRepositoryInterface
{
    const ENTITY = Product::class;
}
