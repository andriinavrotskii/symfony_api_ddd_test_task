<?php

namespace App\Domain\Request;

class FinishReceiptRequest
{
    private $receiptId;

    /**
     * FinishReceiptRequest constructor.
     * @param $receiptId
     */
    public function __construct($receiptId)
    {
        $this->receiptId = $receiptId;
    }

    /**
     * @return mixed
     */
    public function getReceiptId()
    {
        return $this->receiptId;
    }
}
