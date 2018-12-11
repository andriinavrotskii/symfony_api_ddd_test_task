<?php

namespace App\Domain\Request;

class ReceiptReportRequest
{
    /** @var integer */
    private $receiptId;

    /**
     * FinishReceiptRequest constructor.
     * @param int $receiptId
     */
    public function __construct(int $receiptId)
    {
        $this->receiptId = $receiptId;
    }

    /**
     * @return int
     */
    public function getReceiptId(): int
    {
        return $this->receiptId;
    }
}
