<?php

namespace Jonczek\Tax\Calculator;

/**
 * Calculator for Trade Tax (Gewerbesteuer)
 */
class TradeTaxCalculator
{
    const TAX_ALLOWANCE = 24500;

    public function calculate(float $value, int $rateOfAssessment)
    {
        if ($value <= self::TAX_ALLOWANCE) {
            return 0;
        }

        $tradeTax = $value - self::TAX_ALLOWANCE;
        $tradeTax = floor($tradeTax * 3.5 / 100);
        $tradeTax = $tradeTax  * $rateOfAssessment / 100;

        return $tradeTax;
    }
}