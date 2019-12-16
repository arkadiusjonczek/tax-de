<?php

namespace Jonczek\Tax\Calculator;

/**
 * Calculator for Trade Tax (Gewerbesteuer)
 */
class TradeTaxCalculator
{
    /**
     * Tax allowance for trade tax.
     */
    const TAX_ALLOWANCE = 24500;

    /**
     * @param float $value
     * @param int $rateOfAssessment
     * @return float
     */
    public function calculate(float $value, int $rateOfAssessment)
    {
        if ($value <= self::TAX_ALLOWANCE) {
            return 0.0;
        }

        $tradeTax = $value - self::TAX_ALLOWANCE;
        $tradeTax = floor($tradeTax * 3.5 / 100);
        $tradeTax = $tradeTax  * $rateOfAssessment / 100;

        return (float)$tradeTax;
    }
}