<?php

namespace App\Domain\Request;

use Symfony\Component\Validator\Constraints as Assert;

class AddProductToReceiptRequest implements RequestInterface
{
    /**
     * @var int
     * @Assert\NotBlank(message="Provide receipt id")
     * @Assert\Type(type="integer", message="Receipt id must be an integer")
     * @Assert\GreaterThan(value="0", message="Receipt id should be greater than zero")
     */
    private $receiptId;

    /**
     * @var string
     * @Assert\NotBlank(message="Provide Barcode")
     * @Assert\Type(type="string", message="Barcode must be a string")
     */
    private $barcode;

    /**
     * @var int
     * @Assert\NotBlank(message="Provide amount of Product")
     * @Assert\Type(type="integer", message="Amount of Product must be an integer")
     * @Assert\GreaterThan(value="0", message="Amount of Product must be is greater than zero")
     */
    private $amount;

    /**
     * AddProductToReceiptRequest constructor.
     * @param $receiptId
     * @param $barcode
     * @param $amount
     */
    public function __construct($receiptId, $barcode, $amount)
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
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }
}
