<?php

namespace App\Domain\ValueObject;

use App\Domain\Exceptions\MoneyException;

class Money
{
    const PRECISION = 2;

    const PERIOD_DELIMITER = '.';

    /** @var int */
    private $value;

    /**
     * Money constructor.
     * @param int|string $value
     * @throws MoneyException
     */
    public function __construct($value)
    {
        if (is_string($value)) {
            $this->fromString($value);
        } else {
            $this->fromInteger($value);
        }
    }

    /**
     * @param int $value
     */
    public function fromInteger(int $value)
    {
        $this->value = $value;
    }

    /**
     * @param string $value
     * @throws MoneyException
     */
    public function fromString(string $value)
    {
        switch (strlen(strstr($value, self::PERIOD_DELIMITER))) {
            case false:
            case 0:
                $value = ($value . self::PERIOD_DELIMITER . '00');
                break;
            case 1:
                $value = ($value . '00');
                break;
            case 2:
                $value = ($value . '0');
                break;
            case 3:
                $value = $value;
                break;
            default:
                throw new MoneyException('Wrong Money string');
        }

        $this->value = (int) str_replace(self::PERIOD_DELIMITER, '', $value);
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $value = (string) $this->value;

        if (strlen($value) < self::PRECISION+1) {
            $value = str_repeat('0', (self::PRECISION - strlen($value) + 1))
                . $value;
        }

        return substr_replace($value, self::PERIOD_DELIMITER, -self::PRECISION, 0);
    }
}