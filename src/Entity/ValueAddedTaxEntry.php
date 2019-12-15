<?php

namespace Jonczek\Tax\Entity;

use Jonczek\Tax\Enum\ValueAddedTaxRate;

/**
 * Class ValueAddedTaxEntry
 */
class ValueAddedTaxEntry
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
     * @var int
     * @see ValueAddedTaxRate
     */
    protected $rate;

    /**
     * @var float
     */
    protected $tax;

    /**
     * ValueAddedTaxEntry constructor.
     *
     * @param float $value
     * @param int   $rate
     * @param bool  $isNet
     */
    public function __construct(float $value, int $rate = ValueAddedTaxRate::FULL_RATE, bool $isNet = false)
    {
        if ($isNet) {
            $this->net = $value;
        } else {
            $this->gross = $value;
        }

        $this->rate = $rate;
        $this->recalculate($isNet);
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
     * @return int
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @return float
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param bool $isNet
     */
    protected function recalculate(bool $isNet)
    {
        if ($isNet) {
            $this->gross = $this->net * (100+$this->rate) / 100;
        } else {
            $this->net = $this->gross * 100 / (100+$this->rate);
        }

        $this->tax = $this->gross - $this->net;
    }
}