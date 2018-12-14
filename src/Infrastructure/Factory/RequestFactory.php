<?php

namespace App\Infrastructure\Factory;

use App\Domain\Exceptions\ValidationException;
use App\Domain\Factory\RequestFactoryInterface;
use App\Domain\Request\AddProductToReceiptRequest;
use App\Domain\Request\BarcodeRequest;
use App\Domain\Request\CreateProductRequest;
use App\Domain\Request\ProductsListRequest;
use App\Domain\Request\ReceiptLastProductAmountUpdateRequest;
use App\Domain\Request\ReceiptRequest;
use App\Domain\Request\RequestInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestFactory implements RequestFactoryInterface
{
    /**
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * AddProductToReceiptRequestFactory constructor.
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param $receiptId
     * @param $barcode
     * @param $amount
     * @return \App\Domain\Request\RequestInterface
     * @throws \App\Domain\Exceptions\ValidationException
     */
    public function createAddProductToReceiptRequest($receiptId, $barcode, $amount)
    {
        return $this->validateRequest(
            new AddProductToReceiptRequest($receiptId, $barcode, $amount)
        );
    }

    /**
     * @param $barcode
     * @return RequestInterface
     * @throws ValidationException
     */
    public function createBarcodeRequest($barcode)
    {
        return $this->validateRequest(
            new BarcodeRequest($barcode)
        );
    }

    /**
     * @param $barcode
     * @param $name
     * @param $cost
     * @param $vat
     * @return RequestInterface
     * @throws ValidationException
     */
    public function createCreateProductRequest($barcode, $name, $cost, $vat)
    {
        return $this->validateRequest(
            new CreateProductRequest($barcode, $name, $cost, $vat)
        );
    }

    /**
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return RequestInterface
     * @throws ValidationException
     */
    public function createProductsListRequest(array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->validateRequest(
            new ProductsListRequest($orderBy, $limit, $offset)
        );
    }

    /**
     * @param $receiptId
     * @param $amount
     * @return RequestInterface
     * @throws ValidationException
     */
    public function createReceiptLastProductAmountUpdateRequest($receiptId, $amount)
    {
        return $this->validateRequest(
            new ReceiptLastProductAmountUpdateRequest($receiptId, $amount)
        );
    }

    /**
     * @param $receiptId
     * @return RequestInterface
     * @throws ValidationException
     */
    public function createReceiptRequest($receiptId)
    {
        return $this->validateRequest(
            new ReceiptRequest($receiptId)
        );
    }

    /**
     * @param RequestInterface $request
     * @param null $groups
     * @return RequestInterface
     * @throws ValidationException
     */
    private function validateRequest(RequestInterface $request, $groups = null)
    {
        $errors = $this->validator->validate($request, null, $groups);
        if ($errors->count() > 0) {
            throw new ValidationException($errors);
        }

        return $request;
    }
}