<?php

declare(strict_types=1);

namespace Booking\Service\Currency;

final class Converter
{
    private const RATIOS = [
        'RUB' => 0.01,
    ];
    
    /**
     * @param int $amount
     * @param string $currency
     *
     * @return float
     *
     * @throws UnknownCurrencyException
     */
    public function convertToMajors(int $amount, string $currency): float
    {
        if (array_key_exists($currency, self::RATIOS)) {
            return (float)($amount * self::RATIOS[$currency]);
        }
        
        throw new UnknownCurrencyException(sprintf('Unknown currency %s', $currency));
    }
}
