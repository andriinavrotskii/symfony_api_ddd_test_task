<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\Money;
use App\Domain\ValueObject\Vat;

interface ProductInterface
{
    /**
     * @return string
     */
    public function getBarcode(): string;

    /**
     * @param string $barcode
     */
    public function setBarcode(string $barcode): void;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     */
    public function setName(string $name): void;

    /**
     * @return Money
     */
    public function getCost(): Money;

    /**
     * @param Money $cost
     */
    public function setCost(Money $cost): void;

    /**
     * @return Vat
     */
    public function getVat(): Vat;

    /**
     * @param Vat $vat
     */
    public function setVat(Vat $vat): void;
}