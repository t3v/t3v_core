<?php
namespace T3v\T3vCore\ViewHelpers;

use T3v\T3vCore\ViewHelpers\AbstractViewHelper;

/**
 * The default view helper class.
 *
 * @package T3v\T3vCore\ViewHelpers
 */
class DefaultViewHelper extends AbstractViewHelper {
  /**
   * The view helper render function.
   *
   * @param string $value The value
   * @param string $default The default value, defaults to `-`
   * @return string The value if available, otherwise the default
   */
  public function render(string $value, string $default = '-') {
    return $value ?: $default;
  }
}