<?php

namespace App\Domain\Repository;

use App\Domain\Entity\SelectedProduct;

interface SelectedProductRepositoryInterface extends AbstractRepositoryInterface
{
    const ENTITY = SelectedProduct::class;
}
