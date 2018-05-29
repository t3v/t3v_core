<?php
namespace T3v\T3vCore\ViewHelpers;

use T3v\T3vCore\ViewHelpers\AbstractViewHelper;

/**
 * The page view helper class.
 *
 * @package T3v\T3vCore\ViewHelpers
 */
class PageViewHelper extends AbstractViewHelper {
  /**
   * The page service.
   *
   * @var \T3v\T3vCore\Service\PageService
   * @inject
   */
  protected $pageService;

  /**
   * The view helper render function.
   *
   * @param int $uid The UID of the page
   * @param boolean $languageOverlay If set, the language record (overlay) will be applied, defaults to `true`
   * @param int $sysLanguageUid The optional system language UID, defaults to the current system language UID
   * @return array The page object
   */
  public function render(int $uid, boolean $languageOverlay = true, int $sysLanguageUid = -1) {
    return $this->pageService->getPageByUid($uid, $languageOverlay, $sysLanguageUid);
  }
}