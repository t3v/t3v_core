<?php
namespace T3v\T3vCore\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;

use Cocur\Slugify\Slugify;

/**
 * The slug view helper class.
 *
 * @package T3v\T3vCore\ViewHelpers
 */
class SlugViewHelper extends AbstractViewHelper implements CompilableInterface {
  /**
   * The view helper render function.
   *
   * @param string $value The value to generate a slug from
   * @param string $separator The optional separator, defaults to `-`
   * @return string The rendered output
   */
  public function render(string $value, string $separator = '-') {
    return static::renderStatic(
      [
        'value'     => $value,
        'separator' => $separator
      ],
      $this->buildRenderChildrenClosure(),
      $this->renderingContext
    );
  }

  /**
   * The view helper render static function.
   *
   * @param array $arguments The arguments
   * @param callable $renderChildrenClosure The render children closure
   * @param RenderingContextInterface $renderingContext The rendering context
   * @return string The rendered output
   */
  public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext) {
    $value     = $arguments['value'];
    $separator = $arguments['separator'];

    $output = '';

    if ($value) {
      $output = self::createSlug($value, $separator);
    }

    return $output;
  }

  /**
   * Creates a slug from a value.
   *
   * @param string $value The value to generate a slug from
   * @param string $separator The optional separator, defaults to `-`
   * @return string The slug
   */
  protected static function createSlug(string $value, string $separator = '-') {
    $slugify = GeneralUtility::makeInstance(Slugify::class);
    $slug    = $slugify->slugify($value, $separator);

    return $slug;
  }
}