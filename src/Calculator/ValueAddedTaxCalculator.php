<?php

namespace Jonczek\Tax\Calculator;

use Jonczek\Tax\Entity\ValueAddedTaxEntry;
use Jonczek\Tax\Repository\BasicRepository;

class ValueAddedTaxCalculator
{
    public function calculate(BasicRepository $repository): array
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

        return ['net' => $net, 'gross' => $gross, 'tax' => $tax];
    }
}