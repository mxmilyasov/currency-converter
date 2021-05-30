<?php

namespace Mxmilyasov\Converter\Controller;

use Mxmilyasov\Converter\Model\ConverterResult;
use Mxmilyasov\Converter\Model\Currency;
use Mxmilyasov\Converter\Repository\ConverterResultRepository;
use Mxmilyasov\Converter\Repository\CurrencyRepository;
use Mxmilyasov\Converter\Utils\MoneyConverter;

class ConvertController extends BaseController
{

    public function anyIndex(): string
    {
        /** @var CurrencyRepository $currencyRepo */
        $currencyRepo = $this->em->getRepository(Currency::class);

        /** @var ConverterResultRepository $converterResultRepo */
        $converterResultRepo = $this->em->getRepository(ConverterResult::class);

        $currencies = $currencyRepo->getCurrencies();
        $lastConvertResult = $converterResultRepo->getLastConvertResult();

        ['fromCurrency' => $fromCurrencyCode, 'toCurrency' => $toCurrencyCode, 'rate' => $rate] = $lastConvertResult;

        return $this->view->render(
            'include/converter.html.twig',
            [
                'currencies' => $currencies,
                'fromCurrencySymbol' => $fromCurrencyCode,
                'toCurrencySymbol' => $toCurrencyCode,
                'lastConvertResult' => $lastConvertResult,
                'lastConvertRate' => $rate
            ]
        );
    }

    public function postConvert(): ?string
    {
        /** @var ConverterResultRepository $converterResultRepo */
        $converterResultRepo = $this->em->getRepository(ConverterResult::class);

        $amount = $_POST['amount'];
        $fromCurrency = $_POST['fromCurrency'];
        $toCurrency = $_POST['toCurrency'];

        if (
            isset($amount) &&
            isset($fromCurrency) &&
            isset($toCurrency)
        ) {
            [$result, $rate] = MoneyConverter::convert($amount, $fromCurrency, $toCurrency);
            $convertedValue = new ConverterResult($fromCurrency, $toCurrency, $amount, $rate, $result);

            $converterResultRepo->save($convertedValue);

            return $result;
        }

        return null;
    }
}
