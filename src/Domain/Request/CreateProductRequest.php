<?php

namespace App\Domain\Request;

class CreateProductRequest
{
    /** @var string */
    protected $barcode;

    /** @var string */
    protected $name;

    /** @var string */
    protected $cost;

    /** @var string */
    protected $vat;

    /**
     * CreateProductRequest constructor.
     * @param string $barcode
     * @param string $name
     * @param string $cost
     * @param string $vat
     */
    public function __construct(string $barcode, string $name, string $cost, string $vat)
    {
        $this->barcode = $barcode;
        $this->name = $name;
        $this->cost = $cost;
        $this->vat = $vat;
    }

    /**
     * @return string
     */
    public function getBarcode(): string
    {
        return $this->barcode;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCost(): string
    {
        return $this->cost;
    }

    /**
     * @return string
     */
    public function getVat(): string
    {
        return $this->vat;
    }
}
