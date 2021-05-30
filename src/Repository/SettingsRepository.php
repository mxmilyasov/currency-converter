<?php

namespace Mxmilyasov\Converter\Repository;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\EntityRepository;
use Mxmilyasov\Converter\Model\Settings;
use Mxmilyasov\Converter\Utils\Database;
use PDO;

/**
 * @extends \Doctrine\ORM\EntityRepository<Settings>
 */
class SettingsRepository extends EntityRepository
{
    public function save(Settings $settings): void
    {
        try {
            $this->_em->persist($settings);
            $this->_em->flush();
        } catch (ORMException $e) {
            echo 'Save error: ' . $e->getMessage();
        }
    }

    public function getHistoryListSize(): string
    {
        $db = Database::getConnection();
        $sql = 'SELECT historyListSize FROM settings';
        $query = $db->query($sql);

        return $query->fetch(PDO::FETCH_COLUMN);
    }

    public function getSelectedCurrencies(): array|false
    {
        $db = Database::getConnection();
        $sql = 'SELECT selectedCurrencies FROM settings';
        $settings = $db->query($sql)->fetch(PDO::FETCH_ASSOC);

        if (isset($settings['selectedCurrencies'])) {
            $currenciesArr = explode(',', $settings['selectedCurrencies']);

            $result = [];
            foreach ($currenciesArr as $currency) {
                $currency = trim($currency);
                $result[] = "'$currency'";
            }

            $implodeCurrencies = implode(', ', $result);

            $sql = "SELECT code FROM currencies WHERE code IN ($implodeCurrencies)";
            $query = $db->query($sql);

            return $query->fetchAll(PDO::FETCH_COLUMN);
        }

        return false;
    }

    public function getAllCurrencyCode(): array|false
    {
        $db = Database::getConnection();
        $sql = 'SELECT code FROM currencies';
        $query = $db->query($sql);

        return $query->fetchAll(PDO::FETCH_COLUMN);
    }

    public function updateSettings(string $settingValue, string $updateMask): void
    {
        $db = Database::getConnection();
        $id = $db->query('SELECT id FROM settings')->fetch(PDO::FETCH_COLUMN);

        $currentSettings = $this->_em->find(Settings::class, $id);

        $settings = $currentSettings ?? new Settings();

        switch ($updateMask) {
            case $updateMask === 'selectedCurrencies':
                $settings->setSelectedCurrencies($settingValue);
                break;
            case $updateMask === 'historyListSize':
                $settings->setHistoryListSize($settingValue);
                break;
        }

        try {
            $this->_em->persist($settings);
            $this->_em->flush();
        } catch (OptimisticLockException | ORMException $e) {
            $this->_em->rollback();
            dump($e);
        }
    }
}
