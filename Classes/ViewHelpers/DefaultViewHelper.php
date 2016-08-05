<?php
namespace T3v\T3vCore\ViewHelpers;

use \T3v\T3vCore\AbstractViewHelper;

/**
 * Default View Helper Class
 *
 * @package T3v\T3vCore\ViewHelpers
 */
class DefaultViewHelper extends AbstractViewHelper {
  /**
   * The View Helper render function.
   *
   * @param string $value The value
   * @param string $default The default, defaults to `-`
   * @return string The value if available, otherwise the default
   */
  public function render($value, $default = '-') {
    return $value ?: $default;
  }
}