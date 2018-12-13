<?php

namespace App\Domain\Exceptions;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends \Exception
{
    /**
     * ValidationException constructor.
     * @param ConstraintViolationListInterface $errors
     */
    public function __construct(ConstraintViolationListInterface $errors)
    {
        $e = [];
        /** @var ConstraintViolationInterface $error */
        foreach ($errors as $error) {
            $e[] = $error->getMessage();
        }

        parent::__construct('Validation failed: ' . implode("; ", $e), 422);
    }
}