<?php

namespace App\Domain\Model;

use App\Domain\ValueObject\Money;
use App\Domain\ValueObject\Vat;
use Doctrine\Common\Collections\ArrayCollection;

class Product
{
    /** @var int */
    private $id;

    /** @var string */
    private $barcode;

    /** @var string */
    private $name;

    /** @var Money */
    private $cost;

    /** @var Vat */
    private $vat;

//    /** @var SelectedProduct[]|ArrayCollection */
//    private $selectedProducts;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

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
//
//    /**
//     * @return SelectedProduct[]|ArrayCollection
//     */
//    public function getSelectedProducts()
//    {
//        return $this->selectedProducts;
//    }
}
