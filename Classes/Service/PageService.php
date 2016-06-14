<?php
namespace T3v\T3vCore\Service;

use \TYPO3\CMS\Core\Utility\GeneralUtility;
use \TYPO3\CMS\Frontend\Page\PageRepository;

use \T3v\T3vCore\Service\AbstractService;

/**
 * Class PageService
 *
 * @package T3v\T3vCore\Service
 */
class PageService extends AbstractService {
  const BACKEND_LAYOUT_PREFIX = 'pagets__';

  /**
   * @var \TYPO3\CMS\Frontend\Page\PageRepository
   */
  protected $pageRepository;

  /**
   * The constructor function.
   */
  public function __construct() {
    parent::__construct();

    $this->pageRepository = GeneralUtility::makeInstance('TYPO3\CMS\Frontend\Page\PageRepository');
  }

  /**
   * Helper function to get the current page.
   *
   * @return mixed
   */
  public function getCurrentPage() {
    $page = $GLOBALS['TSFE']->page;
    $uid  = $page['uid'];
    $page = $this->getPage($uid);

    return $page;
  }

  /**
   * Helper function to get a page.
   *
   * @param int $uid The UID of the page.
   * @return mixed
   */
  public function getPage($uid) {
    $page = $this->pageRepository->getPage($uid);

    return $page;
  }

  /**
   * Helper function to get the backend layout for a page.
   *
   * @param int $uid The UID of the page.
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