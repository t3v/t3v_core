<?php
namespace T3v\T3vCore\Helpers;

use \TYPO3\CMS\Core\Utility\GeneralUtility;

use \T3v\T3vCore\Helpers\AbstractHelper;
use \T3v\T3vCore\Service\PageService;

/**
 * Class BodyTagHelper
 *
 * @package T3v\T3vCore\Helpers
 */
class BodyTagHelper extends AbstractHelper {
  const DEFAULT_BODY_CLASS = 'document';

  /**
   * @var \T3v\T3vCore\Service\PageService
   */
  protected $pageService;

  /**
   * The constructor function.
   */
  public function __construct() {
    parent::__construct();

    $this->pageService = GeneralUtility::makeInstance('T3V\T3vCore\Service\PageService');
  }

  public function buildBodyTag($bodyClass) {
    $bodyClass = $bodyClass ?: self::DEFAULT_BODY_CLASS;

    $page          = $this->pageService->getCurrentPage();
    $uid           = $page['uid'];
    $backendLayout = $this->pageService->getBackendLayoutForPage($uid);

    if (!empty($backendLayout)) {
      $bodyClass = "{$backendLayout} {$bodyClass}";
    }

    return '<body class="' . $bodyClass . '">';
  }
}