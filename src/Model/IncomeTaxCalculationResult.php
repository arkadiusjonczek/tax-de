<?php

namespace Jonczek\Tax\Model;

class IncomeTaxCalculationResult
{
    /**
     * @var float
     */
    protected $incomeTax;

    /**
     * @var float
     */
    protected $solidarityTax;

    /**
     * IncomeTaxCalculationResult constructor.
     * @param float $incomeTax
     * @param float $solidarityTax
     */
    public function __construct(float $incomeTax, float $solidarityTax)
    {
        $this->incomeTax     = $incomeTax;
        $this->solidarityTax = $solidarityTax;
    }

    /**
     * @return float
     */
    public function getIncomeTax()
    {
        return $this->incomeTax;
    }

    /**
     * @return float
     */
    public function getSolidarityTax()
    {
        return $this->solidarityTax;
    }
}