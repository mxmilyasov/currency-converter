<?php

namespace Mxmilyasov\Converter\Tests;

use Mxmilyasov\Converter\DTO\Currency;
use PHPUnit\Framework\TestCase;

class CurrencyTest extends TestCase
{

    public function testFullObject(): void
    {
        $location = new Currency('Belarusian Ruble', 'BYN', 'p.');
    }
}
