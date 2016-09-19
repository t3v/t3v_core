<?php
namespace T3v\T3vCore\ViewHelpers;

use \T3v\T3vCore\ViewHelpers\AbstractViewHelper;

/**
 * Language View Helper Class
 *
 * @package T3v\T3vCore\ViewHelpers
 */
class LanguageViewHelper extends AbstractViewHelper {
  /**
   * The View Helper render function.
   *
   * @param string $default The default value, defaults to `en`
   * @return string The current language if available, otherwise the default
   */
  public function render($default = 'en') {
    $language = $this->getLanguage(null);

    return $language ?: $default;
  }
}