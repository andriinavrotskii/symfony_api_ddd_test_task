<?php

namespace App\Infrastructure\Factory;

use App\Domain\Exceptions\ValidationException;
use App\Domain\Request\RequestInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class AbstractRequestFactory
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
     * @param RequestInterface $request
     * @param null $groups
     * @return RequestInterface
     * @throws ValidationException
     */
    protected function validateRequest(RequestInterface $request, $groups = null)
    {
        $errors = $this->validator->validate($request, null, $groups);
        if ($errors->count() > 0) {
            throw new ValidationException($errors);
        }

        return $request;
    }
}