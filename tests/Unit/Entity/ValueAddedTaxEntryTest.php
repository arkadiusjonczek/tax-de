<?php

namespace Jonczek\Tax\Test\Unit\Entity;

use Jonczek\Tax\Entity\ValueAddedTaxEntry;
use Jonczek\Tax\Enum\ValueAddedTaxRate;
use PHPUnit\Framework\TestCase;

/**
 * @group Unit
 * @group ValueAddedTax
 */
class ValueAddedTaxEntryTest extends TestCase
{
    /**
     * @return array
     */
    public function getTestEntryData()
    {
        $data = [];

        $data[] = [
            [ 119, ValueAddedTaxRate::FULL_RATE, false ],
            100,
            119,
            19,
            19
        ];

        $data[] = [
            [ 100, ValueAddedTaxRate::FULL_RATE, true ],
            100,
            119,
            19,
            19
        ];

        $data[] = [
            [ 214, ValueAddedTaxRate::REDUCED_RATE, false ],
            200,
            214,
            7,
            14
        ];

        $data[] = [
            [ 200, ValueAddedTaxRate::REDUCED_RATE, true ],
            200,
            214,
            7,
            14
        ];

        return $data;
    }

    /**
     * @param array $entryArgs
     * @param float $expectedNet
     * @param float $expectedGross
     * @param int $expectedRate
     * @param float $expectedTax
     * @dataProvider getTestEntryData
     */
    public function testEntry(
        array $entryArgs,
        float $expectedNet,
        float $expectedGross,
        int $expectedRate,
        float $expectedTax
    ) {
        $entry = new ValueAddedTaxEntry(...$entryArgs);

        self::assertEquals($expectedNet,   $entry->getNet());
        self::assertEquals($expectedGross, $entry->getGross());
        self::assertEquals($expectedRate,  $entry->getRate());
        self::assertEquals($expectedTax,   $entry->getTax());
    }
}