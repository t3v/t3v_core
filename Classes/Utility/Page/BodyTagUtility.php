<?php
namespace T3v\T3vCore\Utility\Page;

use T3v\T3vCore\Service\PageService;
use T3v\T3vCore\Utility\AbstractUtility;

/**
 * The body tag utility class.
 *
 * @package T3v\T3vCore\Utility\Page
 */
class BodyTagUtility extends AbstractUtility {
  /**
   * The default body CSS class.
   */
  const DEFAULT_BODY_CSS_CLASS = 'document';

  /**
   * The page service.
   *
   * @var \T3v\T3vCore\Service\PageService
   */
  protected $pageService;

  /**
   * Constructs a new body tag utility.
   */
  public function __construct() {
    $this->pageService = $this->objectManager->get(PageService::class);
  }

  /**
   * Builds a body tag.
   *
   * @param string $bodyCssClass The CSS class of the body tag, defaults to `BodyTagUtility::DEFAULT_BODY_CSS_CLASS`
   * @return string The body tag
   */
  public function build(string $bodyCssClass = self::DEFAULT_BODY_CSS_CLASS): string {
    $page          = $this->pageService->getCurrentPage();
    $backendLayout = $this->pageService->getBackendLayoutForPage($page['uid']);

    if (!empty($backendLayout)) {
      $bodyCssClass = "{$backendLayout} {$bodyCssClass}";
    }

    return '<body class="' . $bodyCssClass . '">';
  }
}
