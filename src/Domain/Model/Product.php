<?php

namespace App\Domain\Model;

use App\Domain\ValueObject\Money;
use App\Domain\ValueObject\Vat;

class Product extends BaseEntity
{
    /** @var string */
    protected $barcode;

    /** @var string */
    protected $name;

    /** @var Money */
    protected $cost;

    /** @var Vat */
    protected $vat;
    
    /**
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * @param string $barcode
     */
    public function setBarcode(string $barcode): void
    {
        $this->barcode = $barcode;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Money
     */
    public function getCost(): Money
    {
        return $this->cost;
    }

    /**
     * @param Money $cost
     */
    public function setCost(Money $cost): void
    {
        $this->cost = $cost;
    }

    /**
     * @return Vat
     */
    public function getVat(): Vat
    {
        return $this->vat;
    }

    /**
     * @param Vat $vat
     */
    public function setVat(Vat $vat): void
    {
        $this->vat = $vat;
    }
}
