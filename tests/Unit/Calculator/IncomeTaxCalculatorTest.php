<?php

namespace Jonczek\Tax\Unit\Calculator;

use Jonczek\Tax\Calculator\IncomeTaxCalculator;
use Jonczek\Tax\Enum\PersonalSituation;

/**
 * @group IncomeTax
 */
class IncomeTaxCalculatorTest extends \PHPUnit\Framework\TestCase
{
    public function testCalculate()
    {
        $calculator = new IncomeTaxCalculator();
        $result = $calculator->calculate(50000, PersonalSituation::SINGLE, 2019);

        self::assertEquals(12295, $result['incomeTax']);
        self::assertEquals(676.22, $result['solidarityTax']);

        $result = $calculator->calculate(50000, PersonalSituation::MARRIED, 2019);

        self::assertEquals(7582, $result['incomeTax']);
        self::assertEquals(417.01, $result['solidarityTax']);
    }
}