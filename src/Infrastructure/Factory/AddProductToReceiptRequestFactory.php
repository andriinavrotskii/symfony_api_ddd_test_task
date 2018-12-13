<?php

namespace App\Infrastructure\Factory;

use App\Domain\Request\AddProductToReceiptRequest;

class AddProductToReceiptRequestFactory extends AbstractRequestFactory
{
    /**
     * @param $receiptId
     * @param $barcode
     * @param $amount
     * @return \App\Domain\Request\RequestInterface
     * @throws \App\Domain\Exceptions\ValidationException
     */
    public function create($receiptId, $barcode, $amount)
    {
        return $this->validateRequest(
            new AddProductToReceiptRequest($receiptId, $barcode, $amount)
        );
    }
}