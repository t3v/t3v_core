<?php
declare(strict_types=1);

namespace T3v\T3vCore\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
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
     * Finds an entity by UID with query settings.
     *
     * @param int $uid The UID
     * @param array $querySettings The query settings to apply
     * @param bool $raw Whether to get the raw result without performing overlays, defaults to `false`
     * @return object|null The found entity or null if no entity was found
     */
    public function findByUidWithQuerySettings(int $uid, array $querySettings, bool $raw = false): ?object
    {
        // Creates a new query:
        $query = $this->createQuery();

        // Applies the passed query settings:
        $query = $this->applyQuerySettings($query, $querySettings);

        // Executes the query and returns the result:
        return $query->matching($query->equals('uid', $uid))->execute($raw)->getFirst();
    }

    /**
     * Finds entities by UIDs.
     *
     * @param array|string $uids The UIDs, either as array or as string separated by `,`
     * @param array $querySettings The optional query settings to apply
     * @param bool $raw Whether to get the raw result without performing overlays, defaults to `false`
     * @return array The found entities sorted by the passed UIDs
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

        // Creates a new query:
        $query = $this->createQuery();

        // Applies the optional query settings:
        if (!empty($querySettings)) {
            $query = $this->applyQuerySettings($query, $querySettings);
        }

        // Sets the query constraints:
        $query->matching(
            $query->logicalAnd(
                [
                    $query->in('uid', $uids),
                    $query->equals('hidden', 0),
                    $query->equals('deleted', 0)
                ]
            )
        );

        // Executes the query:
        $result = $query->execute($raw)->toArray();

        // Sorts the result:
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
     * Finds entities by PID.
     *
     * @param int $pid The PID
     * @param array $querySettings The optional query settings to apply
     * @param bool $raw Whether to get the raw result without performing overlays, defaults to `false`
     * @param int $limit The optional limit, defaults to `0`
     * @return QueryResultInterface The found entities
     */
    public function findByPid(int $pid, array $querySettings = [], bool $raw = false, int $limit = 0): QueryResultInterface
    {
        // Creates a new query:
        $query = $this->createquery();

        // Applies the optional query settings:
        if (!empty($querySettings)) {
            $query = $this->applyQuerySettings($query, $querySettings);
        }

        // Sets the query constraints:
        $query->matching(
            $query->logicalAnd(
                [
                    $query->equals('pid', $pid),
                    $query->equals('hidden', 0),
                    $query->equals('deleted', 0)
                ]
            )
        );

        // Sets the query limit if available:
        if ($limit > 0) {
            $query->setLimit($limit);
        }

        // Executes the query and returns the result:
        return $query->execute($raw);
    }

    /**
     * Finds entities by multiple PIDs.
     *
     * @param array|string $pids The PIDs as array or as string, seperated by `,`
     * @param int $limit The optional limit, defaults to `0`
     * @param array $querySettings The optional query settings to apply
     * @param bool $raw Whether to get the raw result without performing overlays, defaults to `false`
     * @return array The found entities sorted by the passed PIDs
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

        // Creates a new query:
        $query = $this->createquery();

        // Applies the optional query settings:
        if (!empty($querySettings)) {
            $query = $this->applyQuerySettings($query, $querySettings);
        }

        // Sets the query constraints:
        $query->matching(
            $query->logicalAnd(
                [
                    $query->in('pid', $pids),
                    $query->equals('hidden', 0),
                    $query->equals('deleted', 0)
                ]
            )
        );

        // Sets the query limit if available:
        if ($limit > 0) {
            $query->setLimit($limit);
        }

        // Executes the query:
        $result = $query->execute($raw)->toArray();

        // Sorts the result:
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
     * Gets a raw object by UID.
     *
     * @param int $uid The UID
     * @param int $languageUid The optional language UID, defaults to `0`
     * @param array $querySettings The optional query settings to apply
     * @return array|null The raw object or null if no object was found
     */
    public function getRawObjectByUid(
        int $uid,
        int $languageUid = 0,
        array $querySettings = ['languageOverlayMode' => false, 'respectStoragePage' => false, 'respectSysLanguage' => false]
    ): ?array {
        if ($uid && $uid > 0) {
            // Creates a new query:
            $query = $this->createquery();

            // Sets the optional language UID:
            if ($languageUid > 0) {
                $query->getQuerySettings()->setLanguageUid($languageUid);
            }

            // Applies the optional query settings:
            if (!empty($querySettings)) {
                $query = $this->applyQuerySettings($query, $querySettings);
            }

            // Sets the query constraints:
            $query->matching($query->equals('uid', $uid));

            // Executes the query and gets the raw object:
            return $query->execute(true)[0];
        }

        return null;
    }

    /**
     * Gets a raw model by UID.
     *
     * Alias for `getRawObjectByUid` function.
     *
     * @param int $uid The UID
     * @param int $languageUid The optional language UID, defaults to `0`
     * @param array $querySettings The optional query settings to apply
     * @return array|null The raw object or null if no object was found
     */
    public function getRawModelByUid(
        int $uid,
        int $languageUid = 0,
        array $querySettings = ['languageOverlayMode' => false, 'respectStoragePage' => false, 'respectSysLanguage' => false]
    ): ?array {
        return $this->getRawObjectByUid($uid, $languageUid, $querySettings);
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

        return $query;
    }
}
