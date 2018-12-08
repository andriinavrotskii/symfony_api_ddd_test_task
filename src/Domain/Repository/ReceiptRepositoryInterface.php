<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Receipt;

interface ReceiptRepositoryInterface extends AbstractRepositoryInterface
{
    const ENTITY = Receipt::class;
}
