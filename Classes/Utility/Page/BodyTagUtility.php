<?php
namespace T3v\T3vCore\Utility\Page;

use T3v\T3vCore\Service\PageService;
use T3v\T3vCore\Utility\AbstractUtility;

/**
 * Body Tag Utility Class
 *
 * @package T3v\T3vCore\Utility\Page
 */
class BodyTagUtility extends AbstractUtility {
  const DEFAULT_BODY_CLASS = 'document';

  /**
   * The page service.
   *
   * @var \T3v\T3vCore\Service\PageService
   */
  protected $pageService;

  /**
   * The constructor function.
   *
   * @return void
   */
  public function __construct() {
    parent::__construct();

    $this->pageService = $this->objectManager->get(PageService::class);
  }

  /**
   * Builds a body tag.
   *
   * @param string $bodyClass The default CSS class of the body tag, defaults to `document`
   * @return string The body tag
   */
  public function build($bodyClass) {
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