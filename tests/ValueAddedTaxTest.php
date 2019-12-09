<?php

namespace Jonczek\tax\de;

use PHPUnit\Framework\TestCase;

class ValueAddedTaxTest extends TestCase
{
    public function testGetSum()
    {
        $valueAddedTax = new ValueAddedTax();
        $valueAddedTax->addEntry(10000);
        $valueAddedTax->addEntry(20000);
        $valueAddedTax->addEntry(10000, ValueAddedTaxRate::REDUCED_RATE);
        $valueAddedTax->addEntry(20000, ValueAddedTaxRate::REDUCED_RATE);
        $valueAddedTax->addEntry(11900, ValueAddedTaxRate::FULL_RATE, false);
        $valueAddedTax->addEntry(21400, ValueAddedTaxRate::REDUCED_RATE, false);

        $tax = $valueAddedTax->getSum();

        static::assertEquals(90000, $tax['net'], 'Net tax must be correct.');
        static::assertEquals(101100, $tax['gross'], 'Gross tax must be correct.');
        static::assertEquals(11100, $tax['tax'], 'Value added tax must be correct.');
    }
}