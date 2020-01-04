<?php

namespace Jonczek\Tax\Calculator;

use Jonczek\Tax\Model\CashAccountingCalculationResult;
use Jonczek\Tax\Repository\GenericRepository;

class CashAccountingCalculator
{
    /**
     * @var ValueAddedTaxCalculator
     */
    protected $calculator;

    /**
     * CashAccountingCalculator constructor.
     *
     * @param ValueAddedTaxCalculator $calculator
     */
    public function __construct(ValueAddedTaxCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * @param GenericRepository $incomeRepository
     * @param GenericRepository $expensesRepository
     *
     * @return CashAccountingCalculationResult
     */
    public function calculate(GenericRepository $incomeRepository, GenericRepository $expensesRepository)
    {
        $incomeResult   = $this->calculator->calculate($incomeRepository);
        $expensesResult = $this->calculator->calculate($expensesRepository);

        return new CashAccountingCalculationResult($incomeResult, $expensesResult);
    }
}