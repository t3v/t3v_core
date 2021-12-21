<?php
declare(strict_types=1);

namespace T3v\T3vCore\Domain\Repository;

use T3v\T3vCore\Domain\Repository\Traits\LocalizationTrait;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * The abstract repository class.
 *
 * @package T3v\T3vCore\Domain\Repository
 */
abstract class AbstractRepository extends Repository
{
    /**
     * Use the localization trait.
     */
    use LocalizationTrait;

    /**
     * The default orderings.
     *
     * @var array
     */
    protected $defaultOrderings = [
        'crdate' => QueryInterface::ORDER_DESCENDING,
        'uid' => QueryInterface::ORDER_DESCENDING
    ];

    /**
     * Finds entities by UIDs.
     *
     * @param array|string $uids The UIDs, either as array or as string separated by `,`
     * @param bool $raw Whether to get the raw result without performing overlays, defaults to `false`
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryInterface The result
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     * @noinspection PhpFullyQualifiedNameUsageInspection
     * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
     */
    public function findByUids($uids, bool $raw = false)
    {
        if (!is_array($uids)) {
            $uids = GeneralUtility::intExplode(',', $uids, true);
        }

        if (empty($uids)) {
            return [];
        }

        $query = $this->createQuery();

        $query->matching(
            $query->logicalAnd(
                [
                    $query->in('uid', $uids),
                    $query->equals('hidden', 0),
                    $query->equals('deleted', 0)
                ]
            )
        );

        $result = $query->execute($raw)->toArray();

        usort(
            $result,
            static function (object $entityA, object $entityB) use ($uids) {
                $indexA = array_search($entityA->getUid(), $uids, true);
                $indexB = array_search($entityB->getUid(), $uids, true);

                return ($indexA < $indexB) ? -1 : 1;
            }
        );

        return $result;
    }

    /**
     * Finds objects by multiple PIDs.
     *
     * @param array|string $pids The PIDs as array or as string, seperated by `,`
     * @param int $limit The optional limit, defaults to `0`
     * @param array $querySettings The optional query settings
     * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult|null The found objects or null if no objects were found
     */
    public function findByPids(
        $pids,
        int $limit = 0,
        array $querySettings = ['respectSysLanguage' => true]
    ): ?\TYPO3\CMS\Extbase\Persistence\Generic\QueryResult
    {
        if (is_string($pids)) {
            $pids = GeneralUtility::intExplode(',', $pids, true);
        }

        if (!empty($pids)) {
            // Create query
            $query = $this->createquery();

            // Apply the passed query settings.
            $query = $this->applyQuerySettings($query, $querySettings);

            // Set the query constraints.
            $query->matching($query->in('pid', $pids));

            // Set the query limit if available.
            if ($limit > 0) {
                $query->setLimit($limit);
            }

            // Set the orderings and maintain the list order.
            // TODO: das funktioniert nicht mehr
            // $orderings = $this->getOrderingsByField('pid', $pids);
            // $query->setOrderings($orderings);

            // Execute the query.
            return $query->execute();
        }

        return null;
    }

    /**
     * Applies settings on a query.
     *
     * @param QueryInterface $query The query
     * @param array $settings The settings to apply
     * @return object The query with the applied settings
     */
    protected function applyQuerySettings(QueryInterface $query, array $settings): object
    {
        if (!empty($settings)) {
            $respectStoragePage = $settings['respectStoragePage'];

            if (is_bool($respectStoragePage)) {
                $query->getQuerySettings()->setRespectStoragePage($respectStoragePage);
            }

            $respectSysLanguage = $settings['respectSysLanguage'];

            if (is_bool($respectSysLanguage)) {
                $query->getQuerySettings()->setRespectSysLanguage($respectSysLanguage);
            }

            $returnRawQueryResult = $settings['returnRawQueryResult'];

            if (is_bool($returnRawQueryResult)) {
                /**
                 * TODO: QuerySettingsInterface::setReturnRawQueryResult() is removed without replacement
                 */
                // $query->getQuerySettings()->setReturnRawQueryResult($returnRawQueryResult);
            }
        }

        return $query;
    }

    /**
     * Gets the orderings by a field.
     *
     * @param string $field The field
     * @param array $values The values
     * @param string $order The optional order, defaults to `QueryInterface::ORDER_DESCENDING`
     * @return array The orderings
     */
    protected function getOrderingsByField(string $field, array $values, string $order = QueryInterface::ORDER_DESCENDING): array
    {
        $orderings = [];

        if (!empty($values)) {
            foreach ($values as $value) {
                $orderings["$field={$value}"] = $order;
            }
        }

        return $orderings;
    }
}
