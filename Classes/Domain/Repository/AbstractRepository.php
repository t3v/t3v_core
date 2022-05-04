<?php
declare(strict_types=1);

namespace T3v\T3vCore\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
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
     * @param array $querySettings The optional query settings
     * @param bool $raw Whether to get the raw result without performing overlays, defaults to `false`
     * @return array The found entities
     * @throws InvalidQueryException
     */
    public function findByUids($uids, array $querySettings = [], bool $raw = false): array
    {
        if (!is_array($uids)) {
            $uids = GeneralUtility::intExplode(',', $uids, true);
        }

        if (empty($uids)) {
            return [];
        }

        // Create the query:
        $query = $this->createQuery();

        // Apply the passed query settings:
        $query = $this->applyQuerySettings($query, $querySettings);

        // Set the query constraints:
        $query->matching(
            $query->logicalAnd(
                [
                    $query->in('uid', $uids),
                    $query->equals('hidden', 0),
                    $query->equals('deleted', 0)
                ]
            )
        );

        // Execute the query:
        $result = $query->execute($raw)->toArray();

        // Sort the result:
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
     * Finds entities by multiple PIDs.
     *
     * @param array|string $pids The PIDs as array or as string, seperated by `,`
     * @param int $limit The optional limit, defaults to `0`
     * @param array $querySettings The optional query settings
     * @param bool $raw Whether to get the raw result without performing overlays, defaults to `false`
     * @return array The found entities
     * @throws InvalidQueryException
     */
    public function findByPids($pids, int $limit = 0, array $querySettings = [], bool $raw = false): array
    {
        if (is_string($pids)) {
            $pids = GeneralUtility::intExplode(',', $pids, true);
        }

        if (empty($pids)) {
            return [];
        }

        // Create the query:
        $query = $this->createquery();

        // Apply the passed query settings:
        $query = $this->applyQuerySettings($query, $querySettings);

        // Set the query constraints:
        $query->matching(
            $query->logicalAnd(
                [
                    $query->in('pid', $pids),
                    $query->equals('hidden', 0),
                    $query->equals('deleted', 0)
                ]
            )
        );

        // Set the query limit if available:
        if ($limit > 0) {
            $query->setLimit($limit);
        }

        // Execute the query:
        $result = $query->execute($raw)->toArray();

        // Sort the result:
        usort(
            $result,
            static function (object $entityA, object $entityB) use ($pids) {
                $indexA = array_search($entityA->getPid(), $pids, true);
                $indexB = array_search($entityB->getPid(), $pids, true);

                return ($indexA < $indexB) ? -1 : 1;
            }
        );

        return $result;
    }

    /**
     * Applies settings on a query.
     *
     * @param QueryInterface $query The query
     * @param array $settings The settings to apply
     * @return QueryInterface The query with the applied settings
     */
    protected function applyQuerySettings(QueryInterface $query, array $settings): QueryInterface
    {
        if (!empty($settings)) {
            $languageOverlayMode = $settings['languageOverlayMode'];

            if (is_bool($languageOverlayMode) || is_string($languageOverlayMode)) {
                $query->getQuerySettings()->setLanguageOverlayMode($languageOverlayMode);
            }

            $respectStoragePage = $settings['respectStoragePage'];

            if (is_bool($respectStoragePage)) {
                $query->getQuerySettings()->setRespectStoragePage($respectStoragePage);
            }

            $respectSysLanguage = $settings['respectSysLanguage'];

            if (is_bool($respectSysLanguage)) {
                $query->getQuerySettings()->setRespectSysLanguage($respectSysLanguage);
            }
        }

        $query->getQuerySettings()->setLanguageOverlayMode(false);

        return $query;
    }
}
