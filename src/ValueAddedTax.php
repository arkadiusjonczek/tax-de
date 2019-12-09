<?php

namespace Jonczek\tax\de;

class ValueAddedTax
{
    protected $entries;

    public function __construct()
    {
        $this->entries = [];
    }

    public function addEntry(int $value, int $rate = ValueAddedTaxRate::FULL_RATE, bool $net = true)
    {
        if ($net === false) {
            $value = $value * 100 / (100+$rate);
        }

        $this->entries[$rate][] = [
            'value' => $value,
            'rate'  => $rate
        ];
    }

    public function getSum()
    {
        $net   = 0;
        $gross = 0;
        $tax   = 0;

        foreach ($this->entries as $rate => $entries) {
            foreach ($entries as $entry) {
                $net   += $entry['value'];
                $gross += $entry['value'] * (100+$rate) / 100;
                $tax   += $entry['value'] * $rate / 100;
            }
        }

        return ['net' => $net, 'gross' => $gross, 'tax' => $tax];
    }
}