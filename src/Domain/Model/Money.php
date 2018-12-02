<?php

namespace App\Domain\Model;

use App\Domain\Exceptions\MoneyException;

class Money
{
    const PERCISION = 2;

    /** @var string */
    private $amount;

    /**
     * Money constructor.
     * @param int $value
     * @throws MoneyException
     */
    public function __construct(int $value)
    {
        $this->fromInteger($value);
    }

    /**
     * @param int $value
     * @throws MoneyException
     */
    public function fromInteger(int $value)
    {
        $value = (string) $value;

        if (strlen($value) < self::PERCISION) {
            throw new MoneyException("Can't create Money from integer, integer too small");
        }

        $this->amount = substr_replace($value, '.', -self::PERCISION, 0);
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }
}