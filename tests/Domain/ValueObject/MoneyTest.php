<?php

namespace App\Tests\Domain\ValueObject;

use App\Domain\ValueObject\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    /**
     * @test
     * @throws \App\Domain\Exceptions\MoneyException
     */
    public function positiveTest()
    {
        $this->assertSame('0.00', (string) new Money(0));
        $this->assertSame('0.09', (string) new Money(9));
        $this->assertSame('0.99', (string) new Money(99));
        $this->assertSame('9.99', (string) new Money(999));
        $this->assertSame('9999.99', (string) new Money(999999));

        $this->assertSame('0.00', (string) new Money('0'));
        $this->assertSame('9.00', (string) new Money('9'));
        $this->assertSame('9.00', (string) new Money('9.'));
        $this->assertSame('0.90', (string) new Money('0.9'));
        $this->assertSame('0.09', (string) new Money('0.09'));
        $this->assertSame('0.99', (string) new Money('0.99'));
        $this->assertSame('9.99', (string) new Money('9.99'));
        $this->assertSame('9999.99', (string) new Money('9999.99'));

        $this->assertEquals(8888, (new Money('88.88'))->getValue());
    }
}