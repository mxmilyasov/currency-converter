<?php

namespace Mxmilyasov\Converter\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Mxmilyasov\Converter\Model\Currency;
use Mxmilyasov\Converter\Utils\Database;
use Mxmilyasov\Converter\Utils\Helper;
use PDO;

/**
 * @extends \Doctrine\ORM\EntityRepository<Currency>
 */
class CurrencyRepository extends EntityRepository
{

    public function getCurrencies(): array|false
    {
        $db = Database::getConnection();

        $query = $db->query('SELECT s.selectedCurrencies FROM settings s');

        $selectedCurrencies = $query->fetch(PDO::FETCH_COLUMN);

        if ($selectedCurrencies) {
            $currenciesArray = explode(',', $selectedCurrencies);

            $result = [];
            foreach ($currenciesArray as $currency) {
                $currency = trim($currency);
                $result[] = "'$currency'";
            }

            $implodedCurrencies = implode(', ', $result);

            $sql = "SELECT code FROM currencies WHERE code IN ($implodedCurrencies)";
        } else {
            $sql = 'SELECT code FROM currencies';
        }

        $query = $db->query($sql);
        $result = $query->fetchAll(PDO::FETCH_COLUMN);

        return $result;
    }

    public function importCurrencies(): bool|string
    {
        $fileName = APP_ROOT . '/public/data/currencies.json';
        $currencies = Helper::getJsonDecodeContent($fileName)['results'];

        foreach ($currencies as $code => $currencyInfo) {
            $currency = new Currency(
                $code,
                $currencyInfo['currencyName'],
                $currencyInfo['currencySymbol'] ?? null
            );

            $this->_em->persist($currency);
        }

        try {
            $this->_em->flush();
        } catch (OptimisticLockException | ORMException $e) {
            $this->_em->rollback();
            return 'Doctrine Error: ' . $e->getMessage();
        }

        return true;
    }
}
