<?php
namespace T3v\T3vCore\Service;

use \TYPO3\CMS\Core\Database\QueryGenerator;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Frontend\Page\PageRepository;

use \T3v\T3vCore\Service\AbstractService;
use \T3v\T3vCore\Service\LanguageService;

/**
 * Page Service Class
 *
 * @package T3v\T3vCore\Service
 */
class PageService extends AbstractService {
  const BACKEND_LAYOUT_PREFIX = 'pagets__';

  /**
   * @var \TYPO3\CMS\Core\Database\QueryGenerator
   */
  protected $queryGenerator;

  /**
   * @var \TYPO3\CMS\Frontend\Page\PageRepository
   */
  protected $pageRepository;

  /**
   * @var \T3v\T3vCore\Service\LanguageService
   */
  protected $languageService;

  /**
   * The constructor function.
   */
  public function __construct() {
    parent::__construct();

    $this->queryGenerator  = $this->objectManager->get('TYPO3\CMS\Core\Database\QueryGenerator');
    $this->pageRepository  = $this->objectManager->get('TYPO3\CMS\Frontend\Page\PageRepository');
    $this->languageService = $this->objectManager->get('T3v\T3vCore\Service\LanguageService');
  }

  /**
   * Helper function to get the current page.
   *
   * @param boolean $overlay If set, the language record (overlay) will be applied, defaults to `true`
   * @return array The row for the current page or empty if no page was found
   */
  public function getCurrentPage($overlay = true) {
    $pid  = intval($GLOBALS['TSFE']->id);
    $page = $this->getPage($pid, $overlay);

    return $page;
  }

  /**
   * Helper function to get a page by UID.
   *
   * @param int $uid The UID of the page
   * @param boolean $overlay If set, the language record (overlay) will be applied, defaults to `true`
   * @return array The row for the page or empty if no page was found
   */
  public function getPage($uid, $overlay = true) {
    $uid  = intval($uid);
    $page = $this->pageRepository->getPage($uid);

    if ($overlay) {
      $sysLanguageUid = $this->languageService->getSysLanguageUid();

      $page = $this->pageRepository->getPageOverlay($page, $sysLanguageUid);
    }

    return $page;
  }

  /**
   * Alias for `getPage`.
   *
   * @param int $uid The UID of the page
   * @param boolean $overlay If set, the language record (overlay) will be applied, defaults to `true`
   * @return array The row for the page or empty if no page was found
   */
  public function getPageByUid($uid, $overlay = true) {
    $uid  = intval($uid);

    return $this->getPage($uid, $overlay);
  }

  /**
   * Helper function to get pages by UIDs.
   *
   * @param mixed $uids The UIDs as array or as string, seperated by `,`
   * @param boolean $overlay If set, the language record (overlay) will be applied, defaults to `true`
   * @return array The pages
   */
  public function getPages($uids, $overlay = true) {
    if (is_string($uids)) {
      $uids = GeneralUtility::intExplode(',', $uids, true);
    }

    $pages = [];

    foreach($uids as $uid) {
      $page = $this->getPage($uid, $overlay);

      if ($page) {
        $pages[] = $page;
      }
    }

    return $pages;
  }

  /**
   * Alias for `getPages`.
   *
   * @param mixed $uids The UIDs as array or as string, seperated by `,`
   * @param boolean $overlay If set, the language record (overlay) will be applied, defaults to `true`
   * @return array The pages
   */
  public function getPagesByUids($uids, $overlay = true) {
    return $this->getPages($uids, $overlay);
  }

  /**
   * Helper function to get the subpages of a page.
   *
   * @param int $pid The PID of the page to search from
   * @param int $recursion The recursion, defaults to `1`
   * @param boolean $exclude If set, the start page should be excluded, defaults to `true`
   * @param boolean $overlay If set, the language record (overlay) will be applied, defaults to `true`
   * @return array The subpages
   */
  public function getSubpages($pid, $recursion = 1, $exclude = true, $overlay = true) {
    $subpages = [];

    $subpagesUids = $this->getSubpagesUids($pid, $recursion, $exclude);

    foreach ($subpagesUids as $subpageUid) {
      $subpage = $this->getPage($subpageUid, $overlay);

      if ($subpage) {
        $subpages[] = $subpage;
      }
    }

    return $subpages;
  }

  /**
   * Helper function to get the UIDs of the subpages of a page.
   *
   * @param int $pid The PID of the page to search from
   * @param int $recursion The recursion level, defaults to `1`
   * @param boolean $exclude If set, the start page should be excluded, defaults to `true`
   * @return array The subpages UIDs
   */
  public function getSubpagesUids($pid, $recursion = 1, $exclude = true) {
    $subpagesUids = [];

    $subpagesTreeList = $this->queryGenerator->getTreeList($pid, $recursion, 0, 1);
    $subpagesUids     = GeneralUtility::intExplode(',', $subpagesTreeList, true);

    if ($exclude) {
      unset($subpagesUids[0]);
    }

    return $subpagesUids;
  }

  /**
   * Helper function to get the backend layout for a page.
   *
   * @param int $uid The UID of the page
   * @return mixed The name of the backend layout or null if no backend layout was found
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
  }
}