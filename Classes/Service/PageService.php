<?php
namespace T3v\T3vCore\Service;

use TYPO3\CMS\Core\Database\QueryGenerator;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Page\PageRepository;

use T3v\T3vCore\Service\AbstractService;
use T3v\T3vCore\Service\LanguageService;

/**
 * The page service class.
 *
 * @package T3v\T3vCore\Service
 */
class PageService extends AbstractService {
  const BACKEND_LAYOUT_PREFIX = 'pagets__';

  /**
   * The query generator.
   *
   * @var \TYPO3\CMS\Core\Database\QueryGenerator
   */
  protected $queryGenerator;

  /**
   * The page repository.
   *
   * @var \TYPO3\CMS\Frontend\Page\PageRepository
   */
  protected $pageRepository;

  /**
   * The language service.
   *
   * @var \T3v\T3vCore\Service\LanguageService
   */
  protected $languageService;

  /**
   * The constructor function.
   */
  public function __construct() {
    parent::__construct();

    $this->queryGenerator  = $this->objectManager->get(QueryGenerator::class);
    $this->pageRepository  = $this->objectManager->get(PageRepository::class);
    $this->languageService = $this->objectManager->get(LanguageService::class);
  }

  /**
   * Gets the current page.
   *
   * @param boolean $languageOverlay If set, the language record (overlay) will be applied, defaults to `true`
   * @param int $sysLanguageUid The optional system language UID, defaults to the current system language UID
   * @return array The row for the current page or empty if no page was found
   */
  public function getCurrentPage($languageOverlay = true, $sysLanguageUid = -1) {
    $uid             = intval($GLOBALS['TSFE']->id);
    $languageOverlay = (boolean) $languageOverlay;
    $sysLanguageUid  = intval($sysLanguageUid);
    $page            = $this->getPage($uid, $languageOverlay, $sysLanguageUid);

    return $page;
  }

  /**
   * Gets a page by UID.
   *
   * @param int $uid The UID of the page
   * @param boolean $languageOverlay If set, the language record (overlay) will be applied, defaults to `true`
   * @param int $sysLanguageUid The optional system language UID, defaults to the current system language UID
   * @return array The row for the page or empty if no page was found
   */
  public function getPage($uid, $languageOverlay = true, $sysLanguageUid = -1) {
    $uid             = intval($uid);
    $languageOverlay = (boolean) $languageOverlay;
    $sysLanguageUid  = intval($sysLanguageUid);
    $page            = $this->pageRepository->getPage($uid);

    if ($languageOverlay) {
      if ($sysLanguageUid < 0) {
        $sysLanguageUid = $this->languageService->getSysLanguageUid();
      }

      $page = $this->pageRepository->getPageOverlay($page, $sysLanguageUid);
    }

    return $page;
  }

  /**
   * Alias for `getPage`.
   *
   * @param int $uid The UID of the page
   * @param boolean $languageOverlay If set, the language record (overlay) will be applied, defaults to `true`
   * @param int $sysLanguageUid The optional system language UID, defaults to the current system language UID
   * @return array The row for the page or empty if no page was found
   */
  public function getPageByUid($uid, $languageOverlay = true, $sysLanguageUid = -1) {
    $uid             = intval($uid);
    $languageOverlay = (boolean) $languageOverlay;
    $sysLanguageUid  = intval($sysLanguageUid);

    return $this->getPage($uid, $languageOverlay, $sysLanguageUid);
  }

  /**
   * Gets pages by UIDs.
   *
   * @param array|string $uids The UIDs as array or as string, seperated by `,`
   * @param boolean $languageOverlay If set, the language record (overlay) will be applied, defaults to `true`
   * @param int $sysLanguageUid The optional system language UID, defaults to the current system language UID
   * @return array The pages
   */
  public function getPages($uids, $languageOverlay = true, $sysLanguageUid = -1) {
    if (is_string($uids)) {
      $uids = GeneralUtility::intExplode(',', $uids, true);
    }

    $languageOverlay = (boolean) $languageOverlay;
    $sysLanguageUid  = intval($sysLanguageUid);
    $pages           = [];

    foreach($uids as $uid) {
      $page = $this->getPage($uid, $languageOverlay, $sysLanguageUid);

      if ($page) {
        $pages[] = $page;
      }
    }

    return $pages;
  }

  /**
   * Alias for `getPages`.
   *
   * @param array|string $uids The UIDs as array or as string, seperated by `,`
   * @param boolean $languageOverlay If set, the language record (overlay) will be applied, defaults to `true`
   * @param int $sysLanguageUid The optional system language UID, defaults to the current system language UID
   * @return array The pages
   */
  public function getPagesByUids($uids, $languageOverlay = true, $sysLanguageUid = -1) {
    if (is_string($uids)) {
      $uids = GeneralUtility::intExplode(',', $uids, true);
    }

    $languageOverlay = (boolean) $languageOverlay;
    $sysLanguageUid  = intval($sysLanguageUid);

    return $this->getPages($uids, $languageOverlay, $sysLanguageUid);
  }

  /**
   * Gets the subpages of a page.
   *
   * @param int $pid The PID of the entry page to search from
   * @param int $recursion The recursion, defaults to `1`
   * @param boolean $exclude If set, the entry page should be excluded, defaults to `true`
   * @param boolean $languageOverlay If set, the language record (overlay) will be applied, defaults to `true`
   * @param int $sysLanguageUid The optional system language UID, defaults to the current system language UID
   * @return array The subpages
   */
  public function getSubpages($pid, $recursion = 1, $exclude = true, $languageOverlay = true, $sysLanguageUid = -1) {
    $pid             = intval($pid);
    $recursion       = intval($recursion);
    $exclude         = (boolean) $exclude;
    $languageOverlay = (boolean) $languageOverlay;
    $sysLanguageUid  = intval($sysLanguageUid);
    $subpages        = [];
    $subpagesUids    = $this->getSubpagesUids($pid, $recursion, $exclude);

    foreach ($subpagesUids as $subpageUid) {
      $subpage = $this->getPage($subpageUid, $languageOverlay, $sysLanguageUid);

      if ($subpage) {
        $subpages[] = $subpage;
      }
    }

    return $subpages;
  }

  /**
   * Gets the UIDs of the subpages of a page.
   *
   * @param int $pid The PID of the entry page to search from
   * @param int $recursion The recursion level, defaults to `1`
   * @param boolean $exclude If set, the entry page should be excluded, defaults to `true`
   * @return array The subpages UIDs
   */
  public function getSubpagesUids($pid, $recursion = 1, $exclude = true) {
    $pid          = intval($pid);
    $recursion    = intval($recursion);
    $exclude      = (boolean) $exclude;
    $subpagesUids = [];

    $subpagesTreeList = $this->queryGenerator->getTreeList($pid, $recursion, 0, 1);
    $subpagesUids     = GeneralUtility::intExplode(',', $subpagesTreeList, true);

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
   */
  public function getBackendLayoutForPage($uid) {
    $uid      = intval($uid);
    $rootLine = $this->pageRepository->getRootLine($uid);

    $index = -1;

    foreach($rootLine as $page) {
      $index++;

      $backendLayout             = $page['backend_layout'];
      $hasBackendLayout          = false;
      $backendLayoutNextLevel    = $page['backend_layout_next_level'];
      $hasBackendLayoutNextLevel = false;

      if (!empty($backendLayout)) {
        $backendLayout = str_replace(self::BACKEND_LAYOUT_PREFIX, '', $backendLayout);
      }

      if (!empty($backendLayout) && $backendLayout != '-1') {
        $hasBackendLayout = true;
      }

      if (!empty($backendLayoutNextLevel)) {
        $backendLayoutNextLevel = str_replace(self::BACKEND_LAYOUT_PREFIX, '', $backendLayoutNextLevel);
      }

      if (!empty($backendLayoutNextLevel) && $backendLayoutNextLevel != '-1') {
        $hasBackendLayoutNextLevel = true;
      }

      if ($index == 0 && $hasBackendLayout) {
        return $backendLayout;
      } elseif ($index > 0 && $hasBackendLayoutNextLevel) {
        return $backendLayoutNextLevel;
      }
    }

    return null;
  }
}