<?php

namespace App\Tests\Domain\ValueObject;

use App\Domain\ValueObject\Vat;
use PHPUnit\Framework\TestCase;

class VatTest extends TestCase
{
    /**
     * @test
     * @throws \App\Domain\Exceptions\VatException
     */
    public function positiveTest()
    {
        $this->assertSame(6, (new Vat(6))->getValue());
        $this->assertSame(21, (new Vat(21))->getValue());
    }
}