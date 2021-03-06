<?php

namespace App\Domain\Request;

use Symfony\Component\Validator\Constraints as Assert;

class ReceiptLastProductAmountUpdateRequest implements RequestInterface
{
    /**
     * @var int
     * @Assert\NotBlank(message="Provide receipt id")
     * @Assert\Type(type="integer", message="Receipt id must be an integer")
     * @Assert\GreaterThan(value="0", message="Receipt id should be greater than zero")
     */
    private $receiptId;

    /**
     * @var int
     * @Assert\NotBlank(message="Provide Amount")
     * @Assert\Type(type="integer", message="Amount must be an integer")
     */
    private $amount;

    /**
     * ReceiptLastProductAmountUpdateRequest constructor.
     * @param $receiptId
     * @param $amount
     */
    public function __construct($receiptId, $amount)
    {
        $this->receiptId = $receiptId;
        $this->amount = $amount;
    }

    /**
     * @return int
     */
    public function getReceiptId(): int
    {
        return (int) $this->receiptId;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return (int) $this->amount;
    }
}
