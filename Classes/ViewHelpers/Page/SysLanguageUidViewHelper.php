<?php
namespace T3v\T3vCore\ViewHelpers\Page;

use \T3v\T3vCore\ViewHelpers\AbstractViewHelper;

/**
 * Sys Language Uid View Helper Class
 *
 * @package T3v\T3vCore\ViewHelpers\Page
 */
class SysLanguageUidViewHelper extends AbstractViewHelper {
  /**
   * The View Helper render function.
   *
   * @param int $default The default value, defaults to `0`
   * @return int The current sys language UID of the page if available, otherwise the default
   */
  public function render($default = 0) {
    $sysLanguageUid = $this->getSysLanguageUid(null);

    return $sysLanguageUid ?: $default;
  }
}