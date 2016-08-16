<?php
namespace T3v\T3vCore\Service;

use \TYPO3\CMS\Core\Database\QueryGenerator;
use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Frontend\Page\PageRepository;

use \T3v\T3vCore\Service\AbstractService;

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
   * The constructor function.
   */
  public function __construct() {
    parent::__construct();

    $this->queryGenerator = GeneralUtility::makeInstance('TYPO3\CMS\Core\Database\QueryGenerator');
    $this->pageRepository = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\Page\PageRepository');
  }

  /**
   * Helper function to get the current page.
   *
   * @return mixed The row for the current page or null if no page was found
   */
  public function getCurrentPage() {
    $pid  = intval($GLOBALS['TSFE']->id);
    $page = $this->getPage($pid);

    return $page;
  }

  /**
   * Helper function to get a page.
   *
   * @param int $pid The page ID of the page
   * @return mixed The row for the page or null if no page was found
   */
  public function getPage($pid) {
    $page = $this->pageRepository->getPage($pid);

    return $page;
  }

  /**
   * Helper function to get the subpages.
   *
   * @param int $pid The page ID of the page to search from
   * @param int $recursion The recursion, defaults to `1`
   * @param boolean $exclude If the start page should be excluded, defaults to `true`
   * @return array The subpages as rows
   */
  public function getSubpages($pid, $recursion = 1, $exclude = true) {
    $subpages = [];

    $subpagesPids = $this->getSubpagesPids($pid, $recursion, $exclude);

    foreach ($subpagesPids as $subpagePid) {
      $subpage = $this->getPage($subpagePid);

      if ($subpage) {
        array_push($subpages, $subpage);
      }
    }

    return $subpages;
  }

  /**
   * Helper function to get the subpages PIDs.
   *
   * @param int $pid The page ID of the page to search from
   * @param int $recursion The recursion, defaults to `1`
   * @param boolean $exclude If the start page should be excluded, defaults to `true`
   * @return array The subpages PIDs
   */
  public function getSubpagesPids($pid, $recursion = 1, $exclude = true) {
    $subpagesPids = [];

    $subpagesTreeList = $this->queryGenerator->getTreeList($pid, $recursion, 0, 1);
    $subpagesPids     = GeneralUtility::intExplode(',', $subpagesTreeList, true);

    if ($exclude) {
      unset($subpagesPids[0]);
    }

    return $subpagesPids;
  }

  /**
   * Helper function to get the backend layout for a page.
   *
   * @param int $uid The UID of the page
   * @return mixed The name of the backend layout or null if no backend layout was found
   */
  public function getBackendLayoutForPage($uid) {
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