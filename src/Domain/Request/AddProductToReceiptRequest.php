<?php

namespace App\Domain\Request;

class AddProductToReceiptRequest
{
    /** @var integer */
    private $receiptId;

    /** @var string */
    private $barcode;

    /** @var int|null */
    private $amount;

    /**
     * AddProductToReceiptRequest constructor.
     * @param int $receiptId
     * @param string $barcode
     * @param int|null $amount
     */
    public function __construct(int $receiptId, string $barcode, ?int $amount)
    {
        $this->receiptId = $receiptId;
        $this->barcode = $barcode;
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
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * @return int|null
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }
}
