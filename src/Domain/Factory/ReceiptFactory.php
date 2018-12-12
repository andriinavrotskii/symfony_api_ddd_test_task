<?php

namespace App\Domain\Factory;

use App\Domain\Entity\Receipt;

class ReceiptFactory
{
    /**
     * @return Receipt
     */
    public function create()
    {
        return new Receipt();
    }
}