<?php

namespace App\Domain\Request;

class BarcodeRequest
{
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
