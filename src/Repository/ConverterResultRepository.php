<?php

namespace Mxmilyasov\Converter\Repository;

use Doctrine\ORM\ORMException;
use Mxmilyasov\Converter\Model\ConverterResult;
use Doctrine\ORM\EntityRepository;
use Mxmilyasov\Converter\Utils\Database;
use Mxmilyasov\Converter\Utils\Pagination;
use PDO;
use phpDocumentor\Reflection\DocBlock\Description;

/**
 * @extends \Doctrine\ORM\EntityRepository<ConverterResult>
 */
class ConverterResultRepository extends EntityRepository
{
    public const HISTORY_LIST_SHOW_DEFAULT = 5;

    public function save(ConverterResult $converterResult): void
    {
        try {
            $this->_em->persist($converterResult);
            $this->_em->flush();
        } catch (ORMException $e) {
            echo 'Save error: ' . $e->getMessage();
        }
    }

    public function getLastConvertResult(): array|false
    {
        $db = Database::getConnection();
        $sql = 'SELECT fromCurrency, toCurrency, convertResult, amount, createdAt 
                FROM converter_results ORDER BY createdAt DESC LIMIT 1';

        return $db->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    public function getConvertResultList(int $page): array|false
    {
        $db = Database::getConnection();

        $sql = 'SELECT historyListSize FROM settings s';
        $historyListSize = $db->query($sql)->fetch(PDO::FETCH_ASSOC);

        $limit = $historyListSize['historyListSize'] ?? self::HISTORY_LIST_SHOW_DEFAULT;
        $offset = ($page - 1) * $limit;

        $sql = 'SELECT * FROM converter_results cr ORDER BY cr.createdAt DESC LIMIT :limit OFFSET :offset';

        $result = $db->prepare($sql);
        $result->bindParam('limit', $limit, PDO::PARAM_INT);
        $result->bindParam('offset', $offset, PDO::PARAM_INT);
        $result->execute();

        $sql = 'SELECT COUNT(id) FROM converter_results';
        $totalConverterResults = (int)$db->query($sql)->fetch(PDO::FETCH_COLUMN);

        $pagination = new Pagination($totalConverterResults, $page, $limit, 'page/');

        return [
            $result->fetchAll(PDO::FETCH_ASSOC),
            $pagination
        ];
    }
}
