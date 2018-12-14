<?php

namespace App\Tests\Domain\Request;

use App\Domain\Request\BarcodeRequest;
use App\Infrastructure\Factory\RequestFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class RequestTest extends KernelTestCase
{
    /** @var RequestFactory */
    private $factory;

    public function setUp()
    {
        class_exists(Assert\NotBlank::class);
        class_exists(Assert\Type::class);
        class_exists(Assert\GreaterThan::class);
        class_exists(Assert\Regex::class);

        $validator = Validation::createValidatorBuilder()->enableAnnotationMapping()->getValidator();
        $this->factory = new RequestFactory($validator);
    }

    /**
     * @test
     * @expectedException \App\Domain\Exceptions\ValidationException
     */
    public function addProductToReceiptRequestNegative()
    {
        $this->factory->createAddProductToReceiptRequest(0, 4234234, 0);
    }

    /**
     * @test
     */
    public function addBarcodeRequestPositive()
    {
        $barcode = 'asdasddasdasd';

        /** @var BarcodeRequest $request */
        $request = $this->factory->createBarcodeRequest($barcode);

        $this->assertInstanceOf(BarcodeRequest::class, $request);
        $this->assertSame($barcode, $request->getBarcode());
    }
}