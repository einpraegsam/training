<?php
declare(strict_types=1);
namespace In2code\Personregister\Domain\Repository;

use In2code\Personregister\Domain\Model\Dto\Filter;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class PersonRepository
 * Use https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/Database/Configuration/Index.html
 * to define more then only 1 database
 */
class PersonRepository
{
    /**
     * @param Filter|null $filter
     * @return array
     */
    public function findByFilter(Filter $filter = null): array
    {
    }

    /**
     * See https://docs.typo3.org/m/typo3/reference-coreapi/master/en-us/ApiOverview/Database/QueryBuilder/Index.html
     * for some exapmles how to use the querybuilder in TYPO3
     *
     * @param int $identifier
     * @return array
     */
    public function findByUid(int $identifier): array
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('inschrift');
        return (array)$queryBuilder
            ->select('id', 'inschrift', 'text')
            ->from('inschrift')
            ->where(
                $queryBuilder->expr()->eq('id', $queryBuilder->createNamedParameter($identifier, \PDO::PARAM_INT))
            )
            ->execute()
            ->fetch();
    }
}
