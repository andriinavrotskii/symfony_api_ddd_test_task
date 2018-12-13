<?php

namespace App\Domain\Request;

use Symfony\Component\Validator\Constraints as Assert;

class CreateProductRequest implements RequestInterface
{
    /**
     * @var string
     * @Assert\NotBlank(message="Provide Barcode")
     * @Assert\Type(type="string", message="Barcode must be a string")
     */
    protected $barcode;

    /**
     * @var string
     * @Assert\NotBlank(message="Provide Name")
     * @Assert\Type(type="string", message="Name must be a string")
     */
    protected $name;

    /**
     * @var string
     * @Assert\NotBlank(message="Provide Cost")
     * @Assert\Regex(pattern="\d{1,10}\.\d{2}", message="Cost in wrong format")
     */
    protected $cost;

    /**
     * @var string
     * @Assert\NotBlank(message="Provide Vat")
     * @Assert\Regex(pattern="\d", message="Vat in wrong format")
     */
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
