<?php
declare(strict_types=1);

namespace T3v\T3vCore\Service;

use TYPO3\CMS\Core\Database\QueryGenerator;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Page\PageRepository;

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
     * @var \TYPO3\CMS\Frontend\Page\PageRepository
     * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
     */
    protected $pageRepository;

    /**
     * The query generator.
     *
     * @var \TYPO3\CMS\Core\Database\QueryGenerator
     * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
     */
    protected $queryGenerator;

    /**
     * The localization service.
     *
     * @var \T3v\T3vCore\Service\LocalizationService
     * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
     */
    protected $localizationService;

    /**
     * Constructs a new page service.
     */
    public function __construct()
    {
        // parent::__construct();

        $this->pageRepository = GeneralUtility::makeInstance(PageRepository::class);
        $this->queryGenerator = GeneralUtility::makeInstance(QueryGenerator::class);
        $this->localizationService = GeneralUtility::makeInstance(LocalizationService::class);
    }

    /**
     * Gets the current page.
     *
     * @param int $languageUid The optional language UID, defaults to the UID of the current system language
     * @return array|null The row for the page or null if no page was found
     */
    public function getCurrentPage(int $languageUid = null): ?array
    {
        $uid = (int)$GLOBALS['TSFE']->id;

        return $this->getPage($uid, $languageUid);
    }

    /**
     * Gets a page.
     *
     * @param int $uid The UID of the page
     * @param int $languageUid The optional language UID, defaults to the UID of the current system language
     * @return array|null The row for the page or null if no page was found
     */
    public function getPage(int $uid, int $languageUid = null): ?array
    {
        $page = null;
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
     * Gets a page by UID, alias for `getPage`.
     *
     * @param int $uid The UID of the page
     * @param int $languageUid The optional language UID, defaults to the UID of the current system language
     * @return array|null The row for the page or null if no page was found
     */
    public function getPageByUid(int $uid, int $languageUid = null): ?array
    {
        return $this->getPage($uid, $languageUid);
    }

    /**
     * Gets pages.
     *
     * @param array|string $uids The UIDs as array or as string, separated by `,`
     * @param int $languageUid The optional language UID, defaults to the UID of the current system language
     * @return array The pages or empty if no pages were found
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
     * Gets pages by UIDs, alias for `getPages`.
     *
     * @param array|string $uids The UIDs as array or as string, separated by `,`
     * @param int $languageUid The optional language UID, defaults to the UID of the current system language
     * @return array The pages or empty if no pages were found
     */
    public function getPagesByUids($uids, int $languageUid = null): array
    {
        return $this->getPages($uids, $languageUid);
    }

    /**
     * Gets the subpages of a page.
     *
     * @param int $pid The PID of the entry page to search from
     * @param int $recursion The recursion, defaults to `1`
     * @param bool $exclude If set, the entry page should be excluded, defaults to `true`
     * @param int $languageUid The optional language UID, defaults to the UID of the current system language
     * @return array The subpages or empty if no subpages were found
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
     * @param int $recursion The recursion level, defaults to `1`
     * @param bool $exclude If set, the entry page should be excluded, defaults to `true`
     * @return array The subpages UIDs or empty if no subpages UIDs were found
     */
    public function getSubpagesUids(int $pid, int $recursion = 1, bool $exclude = true): array
    {
        $subpagesUids = [];
        $treeList = $this->queryGenerator->getTreeList($pid, $recursion, 0, 1);
        $recordUids = GeneralUtility::intExplode(',', $treeList, true);

        if ($recordUids) {
            foreach ($recordUids as $recordUid) {
                if ($this->getPage($recordUid)) {
                    $subpagesUids[] = $recordUid;
                }
            }
        }

        if ($exclude) {
            unset($subpagesUids[0]);
        }

        return $subpagesUids;
    }

    /**
     * Gets the backend layout for a page.
     *
     * @param int $uid The UID of the page
     * @return string|null The backend layout or null if no backend layout was found
     * @throws \Exception
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function getBackendLayoutForPage(int $uid): ?string
    {
        $rootLine = $this->pageRepository->getRootLine($uid);

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
