<?php

namespace Jonczek\Tax\Model;

class ValueAddedTaxCalculationResult
{
    /**
     * @var float
     */
    protected $net;

    /**
     * @var float
     */
    protected $gross;

    /**
     * @var float
     */
    protected $tax;

    /**
     * ValueAddedTaxCalculationResponse constructor.
     *
     * @param float $net
     * @param float $gross
     * @param float $tax
     */
    public function __construct(float $net, float $gross, float $tax)
    {
        $this->net   = $net;
        $this->gross = $gross;
        $this->tax   = $tax;
    }

    /**
     * @return float
     */
    public function getNet()
    {
        return $this->net;
    }

    /**
     * @return float
     */
    public function getGross()
    {
        return $this->gross;
    }

    /**
     * @return float
     */
    public function getTax()
    {
        return $this->tax;
    }
}