<?php
namespace T3v\T3vCore\ViewHelpers\Page;

use \T3v\T3vCore\ViewHelpers\AbstractViewHelper;

/**
 * Get View Helper Class
 *
 * @package T3v\T3vCore\ViewHelpers\Page
 */
class GetViewHelper extends AbstractViewHelper {
  /**
   * @var \T3v\T3vCore\Service\PageService
   * @inject
   */
  protected $pageService;

  /**
   * The View Helper render function.
   *
   * @param string $uid The UID of the page
   * @param boolean $overlay If set, the language record (overlay) will be applied, defaults to `true`
   * @return object The page object
   */
  public function render($uid, $overlay = true) {
    return $this->pageService->getPageByUid($uid, $overlay);
  }
}