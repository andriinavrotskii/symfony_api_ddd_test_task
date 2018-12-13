<?php

namespace App\Domain\Request;

use Symfony\Component\Validator\Constraints as Assert;

class BarcodeRequest implements RequestInterface
{
    /**
     * @var string
     * @Assert\NotBlank(message="Provide Barcode")
     * @Assert\Type(type="string", message="Barcode must be a string")
     */
    private $barcode;

    /**
     * BarcodeRequest constructor.
     * @param $barcode
     */
    public function __construct($barcode)
    {
        $this->barcode = $barcode;
    }

    /**
     * @return mixed
     */
    public function getBarcode()
    {
        return $this->barcode;
    }
}
