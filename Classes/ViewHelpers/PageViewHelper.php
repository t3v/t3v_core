<?php
namespace T3v\T3vCore\ViewHelpers;

use \T3v\T3vCore\ViewHelpers\AbstractViewHelper;

/**
 * Page View Helper Class
 *
 * @package T3v\T3vCore\ViewHelpers
 */
class PageViewHelper extends AbstractViewHelper {
  /**
   * @var \T3v\T3vCore\Service\PageService
   * @inject
   */
  protected $pageService;

  /**
   * The View Helper render function.
   *
   * @param int $uid The UID of the page
   * @param boolean $languageOverlay If set, the language record (overlay) will be applied, defaults to `true`
   * @return object The page object
   */
  public function render($uid, $languageOverlay = true) {
    $uid             = intval($uid);
    $languageOverlay = (boolean) $languageOverlay;

    return $this->pageService->getPageByUid($uid, $languageOverlay);
  }
}