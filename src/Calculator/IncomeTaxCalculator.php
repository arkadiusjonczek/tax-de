<?php

namespace Jonczek\Tax\Calculator;

use Jonczek\Tax\Enum\PersonalSituation;
use Jonczek\Tax\Exception\CalculateException;
use Jonczek\Tax\Model\IncomeTaxCalculationResult;

/**
 * Calculator for income tax (Einkommensteuer)
 */
class IncomeTaxCalculator
{
    const SOLIDARITY_TAX_ALLOWANCE = 972;
    const SOLIDARITY_TAX_FULL      = 1340;

    /**
     * @param float $taxableProfit
     * @param int $personalSituation
     * @param int $year
     * @return IncomeTaxCalculationResult
     * @throws CalculateException
     */
    public function calculate(float $taxableProfit, int $personalSituation, int $year)
    {
        if ($year <= 2001 && $year >= 2019) {
            throw new CalculateException('The calculation year must be between 2001 and 2019.');
        }

        $incomeTax     = $this->calculateIncomeTax($taxableProfit, $personalSituation, $year);
        $solidarityTax = $this->calculateSolidarityTax($incomeTax, $personalSituation, $year);

        return new IncomeTaxCalculationResult($incomeTax, $solidarityTax);
    }

    /**
     * @param float $taxableProfit
     * @param int $personalSituation
     * @param int $year
     * @return float
     */
    protected function calculateIncomeTax(float $taxableProfit, int $personalSituation, int $year)
    {
        // TODO: Kinderfreibeträge beachten

        $ESt = 0.0;

        if ($personalSituation === PersonalSituation::MARRIED) {
            // splitting method for married
            $taxableProfit = $taxableProfit / 2;
        }

        if ($taxableProfit >= 9169 && $taxableProfit <= 14254) {
            $y = ($taxableProfit - 9168) / 10000;
            $ESt = (980.14 * $y + 1400) * $y;
        } else if ($taxableProfit >= 14255 && $taxableProfit <= 55960) {
            $z = ($taxableProfit - 14254) / 10000;
            $ESt = (216.16 * $z + 2397) * $z + 965.58;
        } else if ($taxableProfit >= 55961 && $taxableProfit <= 265326) {
            $ESt = 0.42 * $taxableProfit - 8780.9;
        } else if ($taxableProfit >= 265327) {
            $ESt = 0.45 * $taxableProfit - 16740.68;
        }

        $ESt = floor($ESt);

        if ($personalSituation === PersonalSituation::MARRIED) {
            // splitting method for married
            $ESt = floor($ESt * 2);
        }

        return (float)$ESt;
    }

    /**
     * @param float $incomeTax
     * @param int $personalSituation
     * @param int $year
     * @return float
     */
    protected function calculateSolidarityTax(float $incomeTax, int $personalSituation, int $year)
    {
        // TODO: Satz und Freigrenze ab 2021 Jahr beachten

        // Freigrenze bis einschließlich 972 EUR bei Singles bzw. 1944 EUR bei Verheirateten
        if ($personalSituation === PersonalSituation::SINGLE && $incomeTax <= self::SOLIDARITY_TAX_ALLOWANCE ||
            $personalSituation === PersonalSituation::MARRIED && $incomeTax <= self::SOLIDARITY_TAX_ALLOWANCE * 2) {
            return 0.0;
        }

        // Innerhalb der Gleitzone von 973 EUR bis 1340 EUR bei Singles bzw. 1944 EUR bis 2680 EUR bei Verheirateten
        // beträgt der Steuersatz 20% abzgl. des Freibetrags, darüber liegt er bei 5,5% auf den vollen Betrag
        if ($personalSituation === PersonalSituation::SINGLE && $incomeTax < self::SOLIDARITY_TAX_FULL ||
            $personalSituation === PersonalSituation::MARRIED && $incomeTax < self::SOLIDARITY_TAX_FULL * 2) {
            if ($personalSituation === PersonalSituation::SINGLE) {
                $incomeTax -= self::SOLIDARITY_TAX_ALLOWANCE;
            } else if ($personalSituation === PersonalSituation::MARRIED) {
                $incomeTax -= self::SOLIDARITY_TAX_ALLOWANCE * 2;
            }
            $solidarityTaxRate = 20;
        } else {
            $solidarityTaxRate = 5.5;
        }

        $solidarityTax = $incomeTax * $solidarityTaxRate / 100;
        $solidarityTax = round($solidarityTax, 2, PHP_ROUND_HALF_DOWN);

        return $solidarityTax;
    }
}