<?php

namespace App\Domain\Request;

class ReceiptLastProductAmountUpdateRequest
{
    /** @var integer */
    private $receiptId;

    /** @var integer */
    private $amount;

    /**
     * ReceiptLastProductAmountUpdateRequest constructor.
     * @param int $receiptId
     * @param int $amount
     */
    public function __construct(int $receiptId, int $amount)
    {
        $this->receiptId = $receiptId;
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getReceiptId(): int
    {
        return $this->receiptId;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }
}
