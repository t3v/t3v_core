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
    protected array $defaultOrderings = [
        'crdate' => QueryInterface::ORDER_DESCENDING,
        'uid' => QueryInterface::ORDER_DESCENDING
    ];

    /**
     * Finds entities by UIDs.
     *
     * @param array|string $uids The UIDs
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
}
