<?php

namespace App\Tests\Domain\Request;

use App\Domain\Exceptions\ValidationException;
use App\Infrastructure\Factory\AddProductToReceiptRequestFactory;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class RequestTest extends KernelTestCase
{

    private $validator;

    public function setUp()
    {
        class_exists(Assert\NotBlank::class);
        class_exists(Assert\Type::class);
        class_exists(Assert\GreaterThan::class);

        $this->validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
    }

    /**
     * @test
     *
     */
    public function addProductToReceiptRequest()
    {

        $factory = new AddProductToReceiptRequestFactory($this->validator);
        try {
            $request = $factory->create(0, 4234234, 0);
            var_dump($request);
        } catch (ValidationException $exception) {
            var_dump($exception->getMessage());
        }
    }
}