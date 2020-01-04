<?php

namespace Jonczek\Tax\Model;

class CashAccountingCalculationResult
{
    /**
     * @var float
     */
    protected $incomeNet;

    /**
     * @var float
     */
    protected $incomeGross;

    /**
     * @var float
     */
    protected $incomeTax;

    /**
     * @var float
     */
    protected $expensesNet;

    /**
     * @var float
     */
    protected $expensesGross;

    /**
     * @var float
     */
    protected $expensesTax;

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
     * CashAccountingModel constructor.
     *
     * @param ValueAddedTaxCalculationResult $incomeResult
     * @param ValueAddedTaxCalculationResult $expensesResult
     */
    public function __construct(
        ValueAddedTaxCalculationResult $incomeResult,
        ValueAddedTaxCalculationResult $expensesResult
    ) {
        $this->incomeNet   = $incomeResult->getNet();
        $this->incomeGross = $incomeResult->getGross();
        $this->incomeTax   = $incomeResult->getTax();

        $this->expensesNet   = $expensesResult->getNet();
        $this->expensesGross = $expensesResult->getGross();
        $this->expensesTax   = $expensesResult->getTax();

        $this->net   = $this->incomeNet   - $this->expensesNet;
        $this->gross = $this->incomeGross - $this->expensesGross;
        $this->tax   = $this->incomeTax   - $this->expensesTax;
    }

    /**
     * @return float
     */
    public function getIncomeNet(): float
    {
        return $this->incomeNet;
    }

    /**
     * @return float
     */
    public function getIncomeGross(): float
    {
        return $this->incomeGross;
    }

    /**
     * @return float
     */
    public function getIncomeTax(): float
    {
        return $this->incomeTax;
    }

    /**
     * @return float
     */
    public function getExpensesNet(): float
    {
        return $this->expensesNet;
    }

    /**
     * @return float
     */
    public function getExpensesGross(): float
    {
        return $this->expensesGross;
    }

    /**
     * @return float
     */
    public function getExpensesTax(): float
    {
        return $this->expensesTax;
    }

    /**
     * @return float
     */
    public function getNet(): float
    {
        return $this->net;
    }

    /**
     * @return float
     */
    public function getGross(): float
    {
        return $this->gross;
    }

    /**
     * @return float
     */
    public function getTax(): float
    {
        return $this->tax;
    }
}