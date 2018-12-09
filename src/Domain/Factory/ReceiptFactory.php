<?php

namespace App\Domain\Factory;

use App\Domain\Entity\Receipt;
use App\Domain\Entity\ReceiptInterface;

class ReceiptFactory
{
    /**
     * @return ReceiptInterface
     */
    public function create()
    {
        return new Receipt();
    }
}