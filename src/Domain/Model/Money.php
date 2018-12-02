<?php

namespace App\Domain\Model;

class Money
{
    const PRECISION = 2;

    const PERIOD_DELIMITER = '.';

    /** @var string */
    private $amount;

    /**
     * Money constructor.
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->fromInteger($value);
    }

    /**
     * @param int $value
     */
    public function fromInteger(int $value)
    {
        $value = (string) $value;

        if (strlen($value) < self::PRECISION+1) {
            $value = str_repeat('0', (self::PRECISION - strlen($value) + 1))
                . $value;
        }

        $this->amount = substr_replace($value, self::PERIOD_DELIMITER, -self::PRECISION, 0);
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }
}