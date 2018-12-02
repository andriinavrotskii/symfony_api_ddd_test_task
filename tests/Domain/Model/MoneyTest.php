<?php

namespace App\Tests\Domain\Model;

use App\Domain\Model\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    /**
     * @test
     */
    public function positiveTest()
    {
        $this->assertSame('0.00', (new Money(0))->getAmount());
        $this->assertSame('0.09', (new Money(9))->getAmount());
        $this->assertSame('0.99', (new Money(99))->getAmount());
        $this->assertSame('9.99', (new Money(999))->getAmount());
        $this->assertSame('9999.99', (new Money(999999))->getAmount());
    }
}