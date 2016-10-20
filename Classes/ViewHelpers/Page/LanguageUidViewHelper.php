<?php
namespace T3v\T3vCore\ViewHelpers\Page;

use \T3v\T3vCore\ViewHelpers\AbstractViewHelper;

/**
 * Language Uid View Helper Class
 *
 * @package T3v\T3vCore\ViewHelpers\Page
 */
class LanguageUidViewHelper extends AbstractViewHelper {
  /**
   * The View Helper render function.
   *
   * @param int $default The default value, defaults to `0`
   * @return int The current language UID of the page if available, otherwise the default
   */
  public function render($default = 0) {
    $languageUid = $this->getLanguageUid(null);

    return $languageUid ?: $default;
  }
}