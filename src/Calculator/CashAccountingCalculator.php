<?php

namespace Jonczek\Tax\Calculator;

use Jonczek\Tax\Model\CashAccountingCalculationResult;
use Jonczek\Tax\Repository\GenericRepository;

class CashAccountingCalculator
{
    /**
     * @param GenericRepository $incomeRepository
     * @param GenericRepository $expensesRepository
     *
     * @return CashAccountingCalculationResult
     */
    public function calculate(GenericRepository $incomeRepository, GenericRepository $expensesRepository)
    {
        $calculator = new ValueAddedTaxCalculator();

        $incomeResult   = $calculator->calculate($incomeRepository);
        $expensesResult = $calculator->calculate($expensesRepository);

        return new CashAccountingCalculationResult($incomeResult, $expensesResult);
    }
}