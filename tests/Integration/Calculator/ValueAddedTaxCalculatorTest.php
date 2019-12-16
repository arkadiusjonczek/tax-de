<?php

namespace Jonczek\Tax\Test\Integration\Calculator;

use Jonczek\Tax\Calculator\ValueAddedTaxCalculator;
use Jonczek\Tax\Entity\ValueAddedTaxEntry;
use Jonczek\Tax\Enum\ValueAddedTaxRate;
use Jonczek\Tax\Repository\GenericRepository;
use PHPUnit\Framework\TestCase;

/**
 * @group Unit
 * @group ValueAddedTax
 */
class ValueAddedTaxCalculatorTest extends TestCase
{
    public function testCalculate()
    {
        $repository = new GenericRepository();
        $repository->add(new ValueAddedTaxEntry(119));
        $repository->add(new ValueAddedTaxEntry(238));
        $repository->add(new ValueAddedTaxEntry(107, ValueAddedTaxRate::REDUCED_RATE));
        $repository->add(new ValueAddedTaxEntry(214, ValueAddedTaxRate::REDUCED_RATE));
        $repository->add(new ValueAddedTaxEntry(100, ValueAddedTaxRate::REDUCED_RATE, true));
        $repository->add(new ValueAddedTaxEntry(200, ValueAddedTaxRate::FULL_RATE, true));

        $calculator = new ValueAddedTaxCalculator();
        $result = $calculator->calculate($repository);

        static::assertEquals(900,  $result->getNet(),   'Net must be correct.');
        static::assertEquals(1023, $result->getGross(), 'Gross must be correct.');
        static::assertEquals(123,  $result->getTax(),   'Value added tax must be correct.');
    }
}