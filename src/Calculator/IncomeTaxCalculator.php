<?php

namespace Jonczek\Tax\Calculator;

use Jonczek\Tax\Enum\PersonalSituation;
use Jonczek\Tax\Exception\CalculateException;

class IncomeTaxCalculator
{
    public function calculate(float $taxableProfit, int $personalSituation, int $year)
    {
        if ($year <= 2001 && $year >= 2019) {
            throw new CalculateException('The calculation year must be between 2001 and 2019.');
        }

        $incomeTax     = $this->calculateIncomeTax($taxableProfit, $personalSituation, $year);
        $solidarityTax = $this->calculateSolidarityTax($incomeTax, $personalSituation, $year);

        return [
            'incomeTax'     => $incomeTax,
            'solidarityTax' => $solidarityTax
        ];
    }

    protected function calculateIncomeTax(float $taxableProfit, int $personalSituation, int $year)
    {
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

        return $ESt;
    }

    protected function calculateSolidarityTax(float $incomeTax, int $personalSituation, int $year)
    {
        // TODO: Freigrenze beachten
        // TODO: Satz je Jahr beachten

        $solidarityTax = $incomeTax * 5.5 / 100;
        $solidarityTax = round($solidarityTax, 2, PHP_ROUND_HALF_DOWN);

        return $solidarityTax;
    }
}