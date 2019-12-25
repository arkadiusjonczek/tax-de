<?php

namespace Jonczek\Tax\Model;

class TradeTaxCalculationResult
{
    /**
     * @var float
     */
    protected $tradeTax;

    /**
     * TradeTaxCalculationResult constructor.
     * @param float $tradeTax
     */
    public function __construct(float $tradeTax)
    {
        $this->tradeTax = $tradeTax;
    }

    /**
     * @return float
     */
    public function getTradeTax()
    {
        return $this->tradeTax;
    }
}