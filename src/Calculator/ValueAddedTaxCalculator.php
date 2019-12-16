<?php

namespace Jonczek\Tax\Calculator;

use Jonczek\Tax\Entity\ValueAddedTaxEntry;
use Jonczek\Tax\Model\ValueAddedTaxCalculationResult;
use Jonczek\Tax\Repository\SimpleRepository;

/**
 * Calculator for value added tax (Umsatzsteuer)
 */
class ValueAddedTaxCalculator
{
    /**
     * @param SimpleRepository $repository
     * @return ValueAddedTaxCalculationResult
     */
    public function calculate(SimpleRepository $repository): ValueAddedTaxCalculationResult
    {
        $net   = 0;
        $gross = 0;
        $tax   = 0;

        foreach ($repository as $entry) {
            /**
             * @var ValueAddedTaxEntry
             */
            $entry;
            $net   += $entry->getNet();
            $gross += $entry->getGross();
            $tax   += $entry->getTax();
        }

        return new ValueAddedTaxCalculationResult($net, $gross, $tax);
    }
}