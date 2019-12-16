<?php

namespace Jonczek\Tax\Test\Unit\Calculator;

use Jonczek\Tax\Calculator\TradeTaxCalculator;
use PHPUnit\Framework\TestCase;

/**
 * @group Unit
 * @group TradeTax
 */
class TradeTaxCalculatorTest extends TestCase
{
    public function testCalculate()
    {
        $calculator = new TradeTaxCalculator();

        $tradeTax = $calculator->calculate(20000, 485);
        self::assertEquals(0, $tradeTax);

        $tradeTax = $calculator->calculate(50000, 485);
        self::assertEquals(4326.20, $tradeTax);
    }
}