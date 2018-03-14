<?php
namespace T3v\T3vCore\ViewHelpers\Page;

use T3v\T3vCore\ViewHelpers\AbstractViewHelper;

/**
 * The language view helper class.
 *
 * @package T3v\T3vCore\ViewHelpers\Page
 */
class LanguageViewHelper extends AbstractViewHelper {
  /**
   * The view helper render function.
   *
   * @param string $default The default value, defaults to `en`
   * @return string The current language of the page if available, otherwise the default
   */
  public function render($default = 'en') {
    $default  = (string) $default;
    $language = $this->getLanguage(null);

    return $language ?: $default;
  }
}