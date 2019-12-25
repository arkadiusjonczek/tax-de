# tax-de

Tax library for german tax calculation.

## Installation

```bash
composer install jonczek/tax-de
```

## Usage

### Value added tax calculation example

Add tax entries to a repository:

```php
$repository = new GenericRepository();
$repository->add(new ValueAddedTaxEntry(119));
$repository->add(new ValueAddedTaxEntry(238));
$repository->add(new ValueAddedTaxEntry(107, ValueAddedTaxRate::REDUCED_RATE));
$repository->add(new ValueAddedTaxEntry(214, ValueAddedTaxRate::REDUCED_RATE));
$repository->add(new ValueAddedTaxEntry(100, ValueAddedTaxRate::REDUCED_RATE, true));
$repository->add(new ValueAddedTaxEntry(200, ValueAddedTaxRate::FULL_RATE, true));
```

Calculate value added tax using the repository:
```php
$calculator = new ValueAddedTaxCalculator();
$result = $calculator->calculate($repository);
```

Result:
```php
Jonczek\Tax\Model\ValueAddedTaxCalculationResult Object
(
    [net:protected] => 900
    [gross:protected] => 1023
    [tax:protected] => 123
)
```