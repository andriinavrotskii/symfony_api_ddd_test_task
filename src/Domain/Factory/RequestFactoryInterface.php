<?php
/**
 * Created by PhpStorm.
 * User: andrii
 * Date: 14.12.18
 * Time: 10:09
 */

namespace App\Domain\Factory;

use App\Domain\Exceptions\ValidationException;
use App\Domain\Request\RequestInterface;

interface RequestFactoryInterface
{
    /**
     * @param $receiptId
     * @param $barcode
     * @param $amount
     * @return \App\Domain\Request\RequestInterface
     * @throws \App\Domain\Exceptions\ValidationException
     */
    public function createAddProductToReceiptRequest($receiptId, $barcode, $amount);

    /**
     * @param $barcode
     * @return RequestInterface
     * @throws ValidationException
     */
    public function createBarcodeRequest($barcode);

    /**
     * @param $barcode
     * @param $name
     * @param $cost
     * @param $vat
     * @return RequestInterface
     * @throws ValidationException
     */
    public function createCreateProductRequest($barcode, $name, $cost, $vat);

    /**
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return RequestInterface
     * @throws ValidationException
     */
    public function createProductsListRequest(array $orderBy = null, $limit = null, $offset = null);

    /**
     * @param $receiptId
     * @param $amount
     * @return RequestInterface
     * @throws ValidationException
     */
    public function createReceiptLastProductAmountUpdateRequest($receiptId, $amount);

    /**
     * @param $receiptId
     * @return RequestInterface
     * @throws ValidationException
     */
    public function createReceiptRequest($receiptId);
}