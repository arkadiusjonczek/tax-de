<?php

namespace Jonczek\Tax\Test\Integration\Calculator;

use Jonczek\Tax\Calculator\CashAccountingCalculator;
use Jonczek\Tax\Calculator\ValueAddedTaxCalculator;
use Jonczek\Tax\Entity\ValueAddedTaxEntry;
use Jonczek\Tax\Repository\GenericRepository;
use PHPUnit\Framework\TestCase;

/**
 * @group Integration
 * @group CashAccounting
 */
class CashAccountingCalculatorTest extends TestCase
{
    public function testCalculate()
    {
        $incomeRepository = new GenericRepository();
        $incomeRepository->add(new ValueAddedTaxEntry(1190));

        $expensesRepository = new GenericRepository();
        $expensesRepository->add(new ValueAddedTaxEntry(110));
        $expensesRepository->add(new ValueAddedTaxEntry(250));
        $expensesRepository->add(new ValueAddedTaxEntry(235));

        $calculator = new CashAccountingCalculator(new ValueAddedTaxCalculator());
        $result = $calculator->calculate($incomeRepository, $expensesRepository);

        self::assertEquals(500, $result->getNet());
        self::assertEquals(595, $result->getGross());
        self::assertEquals(95,  $result->getTax());
    }

    public function testCalculateToNegative()
    {
        $incomeRepository = new GenericRepository();
        $incomeRepository->add(new ValueAddedTaxEntry(1190));

        $expensesRepository = new GenericRepository();
        $expensesRepository->add(new ValueAddedTaxEntry(110));
        $expensesRepository->add(new ValueAddedTaxEntry(250));
        $expensesRepository->add(new ValueAddedTaxEntry(235));
        $expensesRepository->add(new ValueAddedTaxEntry(595));
        $expensesRepository->add(new ValueAddedTaxEntry(200));

        $calculator = new CashAccountingCalculator(new ValueAddedTaxCalculator());
        $result = $calculator->calculate($incomeRepository, $expensesRepository);

        self::assertEquals(-168.07, round($result->getNet(), 2));
        self::assertEquals(-200,    round($result->getGross(), 2));
        self::assertEquals(-31.93,  round($result->getTax(), 2));
    }
}