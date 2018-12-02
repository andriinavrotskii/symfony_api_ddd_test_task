<?php

namespace App\Domain\Model;

use App\Domain\Exceptions\VatTypeException;

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

    public function getValue(): int
    {
        return $this->value;
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