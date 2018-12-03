<?php

namespace App\Domain\ValueObject;

use App\Domain\Exceptions\VatException;

class Vat
{
    const VAT_6 = 6;

    const VAT_21 = 21;

    /** @var int */
    private $value;

    /**
     * VatType constructor.
     * @param $vat int
     * @throws VatException
     */
    public function __construct($vat)
    {
        $this->setValue($vat);
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value . '%';
    }

    /**
     * @param $vat int
     * @throws VatException
     */
    private function setValue(int $vat)
    {
        switch ($vat) {
            case self::VAT_6:
                $this->value = self::VAT_6;
                break;
            case self::VAT_21:
                $this->value = self::VAT_21;
                break;
            default:
                throw new VatException('Unexisting VAT value');
        }
    }
}