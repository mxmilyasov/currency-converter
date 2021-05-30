<?php

namespace Mxmilyasov\Converter\Utils;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Mxmilyasov\Converter\Model\Currency;

class MoneyConverter
{

    private EntityManager $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public static function convert(float $amount, string $from, string $to): array
    {
        $apikey = $_SERVER['CONVERTER_API_KEY'] ?? getenv('CONVERTER_API_KEY');

        $fromCurrency = urlencode($from);
        $toCurrency = urlencode($to);

        $query = "{$fromCurrency}_{$toCurrency}";
        $url = "https://free.currconv.com/api/v7/convert?q=$query&compact=ultra&apiKey=$apikey";

        $decodeResponse = Helper::getJsonDecodeContent($url);

        $value = $decodeResponse["$query"];

        return [
            number_format($value * $amount, 2, '.', ''),
            $value
        ];
    }

    public static function getCurrencies(): bool|int
    {
        $apikey = $_SERVER['CONVERTER_API_KEY'];
        $url = "https://free.currconv.com/api/v7/currencies?apiKey=$apikey";
        $urlContent = file_get_contents($url);

        return file_put_contents(APP_ROOT . '/public/data/currencies.json', $urlContent);
    }
}
