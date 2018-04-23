<?php
namespace T3v\T3vCore\ViewHelpers\Page;

use T3v\T3vCore\ViewHelpers\AbstractViewHelper;

/**
 * The language UID view helper class.
 *
 * @package T3v\T3vCore\ViewHelpers\Page
 */
class LanguageUidViewHelper extends AbstractViewHelper {
  /**
   * The view helper render function.
   *
   * @param int $default The default language UID, defaults to `0`
   * @return int The current language UID of the page if available, otherwise the default one
   */
  public function render(int $default = 0): int {
    $languageUid = $this->getLanguageUid(null);

    return $languageUid ?: $default;
  }
}