<?php
declare(strict_types=1);

namespace T3v\T3vCore\Service;

use Exception;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryHelper;
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;
use TYPO3\CMS\Core\Database\Query\Restriction\WorkspaceRestriction;
use TYPO3\CMS\Core\Database\QueryGenerator;
use TYPO3\CMS\Core\Domain\Repository\PageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\RootlineUtility;

/**
 * The page service class.
 *
 * @package T3v\T3vCore\Service
 */
class PageService extends AbstractService
{
    /**
     * The backend layout prefix.
     */
    public const BACKEND_LAYOUT_PREFIX = 'pagets__';

    /**
     * The page doktypes.
     */
    public const PAGE_DOKTYPES = [1, 2];

    /**
     * The page repository.
     *
     * @var PageRepository
     */
    protected $pageRepository;

    /**
     * The query generator.
     *
     * @var QueryGenerator
     */
    protected $queryGenerator;

    /**
     * The localization service.
     *
     * @var LocalizationService
     */
    protected $localizationService;

    /**
     * Constructs a new page service.
     */
    public function __construct()
    {
        $this->pageRepository = GeneralUtility::makeInstance(PageRepository::class);
        $this->queryGenerator = GeneralUtility::makeInstance(QueryGenerator::class);
        $this->localizationService = GeneralUtility::makeInstance(LocalizationService::class);
    }

    /**
     * Gets a page.
     *
     * @param int $uid The UID of the page
     * @param int|null $languageUid The optional language UID, defaults to the UID of the current system language
     * @return array|null The row for the page or null if no page was found
     * @throws AspectNotFoundException
     */
    public function getPage(int $uid, int $languageUid = null): ?array
    {
        $page = [];
        $record = $this->pageRepository->getPage($uid);

        if (is_array($record) && !empty($record)) {
            if (in_array($record['doktype'], self::PAGE_DOKTYPES, true)) {
                $page = $record;
                $languageUid = $languageUid ?? $this->localizationService->getLanguageUid();

                if ($languageUid > 0) {
                    $page = $this->pageRepository->getPageOverlay($page, $languageUid);
                }
            }
        }

        return $page;
    }

    /**
     * Gets a page by UID.
     *
     * Alias for the `getPage` function.
     *
     * @param int $uid The UID of the page
     * @param int|null $languageUid The optional language UID, defaults to the UID of the current system language
     * @return array|null The row for the page or null if no page was found
     * @throws AspectNotFoundException
     */
    public function getPageByUid(int $uid, int $languageUid = null): ?array
    {
        return $this->getPage($uid, $languageUid);
    }

    /**
     * Gets the current page.
     *
     * @param int|null $languageUid The optional language UID, defaults to the UID of the current system language
     * @return array|null The row for the page or null if no page was found
     * @throws AspectNotFoundException
     */
    public function getCurrentPage(int $languageUid = null): ?array
    {
        $uid = (int)$GLOBALS['TSFE']->id;

        return $this->getPage($uid, $languageUid);
    }

    /**
     * Gets pages.
     *
     * @param array|string $uids The UIDs as array or as string, separated by `,`
     * @param int|null $languageUid The optional language UID, defaults to the UID of the current system language
     * @return array The pages or empty if no pages were found
     * @throws AspectNotFoundException
     */
    public function getPages($uids, int $languageUid = null): array
    {
        $pages = [];

        if (is_string($uids)) {
            $uids = GeneralUtility::intExplode(',', $uids, true);
        }

        if ($uids) {
            foreach ($uids as $uid) {
                $record = $this->getPage($uid, $languageUid);

                if ($record) {
                    $pages[] = $record;
                }
            }
        }

        return $pages;
    }

    /**
     * Gets pages by UIDs.
     *
     * Alias for the `getPages` function.
     *
     * @param array|string $uids The UIDs as array or as string, separated by `,`
     * @param int|null $languageUid The optional language UID, defaults to the UID of the current system language
     * @return array The pages or empty if no pages were found
     * @throws AspectNotFoundException
     */
    public function getPagesByUids($uids, int $languageUid = null): array
    {
        return $this->getPages($uids, $languageUid);
    }

    /**
     * Gets the subpages of a page.
     *
     * @param int $pid The PID of the entry page to search from
     * @param int $recursion The optional recursion, defaults to `1`
     * @param bool $exclude If set, the entry page should be excluded, defaults to `true`
     * @param int|null $languageUid The optional language UID, defaults to the UID of the current system language
     * @return array The subpages or empty if no subpages were found
     * @throws AspectNotFoundException
     */
    public function getSubpages(int $pid, int $recursion = 1, bool $exclude = true, int $languageUid = null): array
    {
        $subpages = [];
        $subpagesUids = $this->getSubpagesUids($pid, $recursion, $exclude);

        if ($subpagesUids) {
            foreach ($subpagesUids as $subpageUid) {
                $record = $this->getPage($subpageUid, $languageUid);

                if ($record) {
                    $subpages[] = $record;
                }
            }
        }

        return $subpages;
    }

    /**
     * Gets the UIDs of the subpages of a page.
     *
     * @param int $pid The PID of the entry page to search from
     * @param int $recursion The optional recursion level, defaults to `1`
     * @param bool $exclude If set, the entry page should be excluded, defaults to `true`
     * @return array The subpages UIDs or empty if no subpages UIDs were found
     */
    public function getSubpagesUids(int $pid, int $recursion = 1, bool $exclude = true): array
    {
        $subpagesUids = [];
        $treeList = $this->getTreeList($pid, $recursion);
        $recordUids = GeneralUtility::intExplode(',', $treeList, true);

        if (!empty($recordUids)) {
            foreach ($recordUids as $recordUid) {
                $subpagesUids[] = $recordUid;
            }
        }

        if ($exclude) {
            unset($subpagesUids[0]);
        }

        return $subpagesUids;
    }

    /**
     * Recursively fetches all descendant pages of a given page.
     *
     * @param int $uid The UID of the page
     * @param int $depth The depth
     * @param int $begin The optional begin, defaults to `0`
     * @param string $permissionClause The optional permission clause, default to ``
     * @return string A comma separated list of descendant pages
     */
    public function getTreeList(int $uid, int $depth, int $begin = 0, string $permissionClause = ''): string
    {
        if ($begin === 0) {
            $treeList = (string)$uid;
        } else {
            $treeList = '';
        }

        if ($uid && $depth > 0) {
            $connectionPool = GeneralUtility::makeInstance(ConnectionPool::class);
            $queryBuilder = $connectionPool->getQueryBuilderForTable('pages');

            $queryBuilder
                ->getRestrictions()
                ->removeAll()
                ->add(GeneralUtility::makeInstance(WorkspaceRestriction::class, 0));

            $queryBuilder
                ->select('uid')
                ->from('pages')
                ->where(
                    $queryBuilder->expr()->eq(
                        'pid',
                        $queryBuilder->createNamedParameter($uid, \PDO::PARAM_INT)
                    ),
                    $queryBuilder->expr()->in(
                        'doktype',
                        $queryBuilder->createNamedParameter(self::PAGE_DOKTYPES, \PDO::PARAM_INT)
                    ),
                    $queryBuilder->expr()->eq(
                        'sys_language_uid',
                        0
                    )
                )
                ->orderBy('uid');

            if (!empty($permissionClause)) {
                $queryBuilder->andWhere(QueryHelper::stripLogicalOperatorPrefix($permissionClause));
            }

            $result = $queryBuilder->execute();

            while ($row = $result->fetch()) {
                if ($begin <= 0) {
                    $treeList .= ',' . $row['uid'];
                }

                if ($depth > 1) {
                    $subTreeList = $this->getTreeList($row['uid'], $depth - 1, $begin - 1, $permissionClause);

                    if (!empty($treeList) && !empty($subTreeList) && ($subTreeList[0] !== ',')) {
                        $treeList .= ',';
                    }

                    $treeList .= $subTreeList;
                }
            }
        }

        return $treeList;
    }

    /**
     * Gets the backend layout for a page.
     *
     * @param int $uid The UID of the page
     * @return string|null The backend layout or null if no backend layout was found
     */
    public function getBackendLayoutForPage(int $uid): ?string
    {
        $rootLine = GeneralUtility::makeInstance(RootlineUtility::class, $uid)->get();

        if ($rootLine) {
            $index = -1;

            foreach ($rootLine as $page) {
                $index++;

                $backendLayout = $page['backend_layout'];
                $hasBackendLayout = false;
                $backendLayoutNextLevel = $page['backend_layout_next_level'];
                $hasBackendLayoutNextLevel = false;

                if (!empty($backendLayout)) {
                    $backendLayout = str_replace(self::BACKEND_LAYOUT_PREFIX, '', $backendLayout);
                }

                if (!empty($backendLayout) && $backendLayout !== '-1') {
                    $hasBackendLayout = true;
                }

                if (!empty($backendLayoutNextLevel)) {
                    $backendLayoutNextLevel = str_replace(self::BACKEND_LAYOUT_PREFIX, '', $backendLayoutNextLevel);
                }

                if (!empty($backendLayoutNextLevel) && $backendLayoutNextLevel !== '-1') {
                    $hasBackendLayoutNextLevel = true;
                }

                if ($index === 0 && $hasBackendLayout) {
                    return $backendLayout;
                }

                if ($index > 0 && $hasBackendLayoutNextLevel) {
                    return $backendLayoutNextLevel;
                }
            }
        }

        return null;
    }
}
