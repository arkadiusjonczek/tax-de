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

    public function testCalculateWithSolidarityTaxAllowance()
    {
        $calculator = new IncomeTaxCalculator();

        $result = $calculator->calculate(14284, PersonalSituation::SINGLE, 2019);

        self::assertEquals(972, $result->getIncomeTax());
        self::assertEquals(0, $result->getSolidarityTax());

        $result = $calculator->calculate(14285, PersonalSituation::SINGLE, 2019);

        self::assertEquals(973, $result->getIncomeTax());
        self::assertEquals(0.20, $result->getSolidarityTax());

        $result = $calculator->calculate(28569, PersonalSituation::MARRIED, 2019);

        self::assertEquals(1944, $result->getIncomeTax());
        self::assertEquals(0, $result->getSolidarityTax());

        $result = $calculator->calculate(28570, PersonalSituation::MARRIED, 2019);

        self::assertEquals(1946, $result->getIncomeTax());
        self::assertEquals(0.40, $result->getSolidarityTax());
    }
}