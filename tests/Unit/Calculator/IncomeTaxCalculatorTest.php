<?php

namespace Jonczek\Tax\Test\Unit\Calculator;

use Jonczek\Tax\Calculator\IncomeTaxCalculator;
use Jonczek\Tax\Enum\PersonalSituation;

/**
 * @group Unit
 * @group IncomeTax
 */
class IncomeTaxCalculatorTest extends \PHPUnit\Framework\TestCase
{
    public function testCalculate()
    {
        $calculator = new IncomeTaxCalculator();
        $result = $calculator->calculate(50000, PersonalSituation::SINGLE, 2019);

        self::assertEquals(12295, $result->getIncomeTax());
        self::assertEquals(676.22, $result->getSolidarityTax());

        $result = $calculator->calculate(50000, PersonalSituation::MARRIED, 2019);

        self::assertEquals(7582, $result->getIncomeTax());
        self::assertEquals(417.01, $result->getSolidarityTax());
    }
}