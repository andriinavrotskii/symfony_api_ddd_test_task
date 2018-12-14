<?php

namespace App\Domain\Request;

use Symfony\Component\Validator\Constraints as Assert;

class ReceiptRequest implements RequestInterface
{
    /**
     * @var int
     * @Assert\NotBlank(message="Provide receipt id")
     * @Assert\Type(type="integer", message="Receipt id must be an integer")
     * @Assert\GreaterThan(value="0", message="Receipt id should be greater than zero")
     */
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
     * @return int
     */
    public function getReceiptId(): int
    {
        return (int) $this->receiptId;
    }
}
