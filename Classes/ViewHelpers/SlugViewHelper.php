<?php
namespace T3v\T3vCore\ViewHelpers;

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
   * The slug rulesets constant.
   */
  const SLUG_RULESETS = [
    'default',
    'azerbaijani',
    'burmese',
    'hindi',
    'georgian',
    'norwegian',
    'vietnamese',
    'ukrainian',
    'latvian',
    'finnish',
    'greek',
    'czech',
    'arabic',
    'turkish',
    'polish',
    'german',
    'russian',
    'romanian',
    'chinese'
  ];

  /**
   * The view helper render function.
   *
   * @param string $input The input to generate a slug from
   * @param string $separator The optional separator, defaults to `-`
   * @return string The rendered output
   */
  public function render(string $input, string $separator = '-') {
    return static::renderStatic(
      [
        'input'     => $input,
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
    $input     = $arguments['input'];
    $separator = $arguments['separator'];
    $output    = '';

    if ($input) {
      $output = self::createSlug($input, $separator);
    }

    return $output;
  }

  /**
   * Creates a slug from a input.
   *
   * @param string $input The input to generate a slug from
   * @param array $rulesets The optional rulesets, defaults to `SlugViewHelper::SLUG_RULESETS`
   * @param string $separator The optional separator, defaults to `-`
   * @return string The slug
   */
  protected static function createSlug(string $input, array $rulesets = self::SLUG_RULESETS, string $separator = '-') {
    $slugify = new Slugify(['rulesets' => $rulesets, 'separator' => $separator]);
    $slug    = $slugify->slugify($input);

    return $slug;
  }
}