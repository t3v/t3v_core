<?php
declare(strict_types=1);

namespace T3v\T3vCore\ViewHelpers;

use Closure;
use Cocur\Slugify\Slugify;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;

/**
 * The slug view helper class.
 *
 * @package T3v\T3vCore\ViewHelpers
 * @deprecated Use `T3v\T3vBase\ViewHelpers\Format\HandleViewHelper` instead, will be removed in a next major version.
 */
class SlugViewHelper extends AbstractViewHelper
{
    /**
     * The rulesets.
     */
    public const RULESETS = [
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
     * Initializes the arguments.
     */
    public function initializeArguments(): void
    {
        parent::initializeArguments();

        $this->registerArgument('input', 'string', 'The input to generate a slug from', true, 'none');
        $this->registerArgument('separator', 'string', 'The optional separator, defaults to `-`', false, '-');
    }

    /**
     * The view helper render static function.
     *
     * @param array $arguments The arguments
     * @param Closure $renderChildrenClosure The render children closure
     * @param RenderingContextInterface $renderingContext The rendering context
     * @return string The slug
     */
    public static function renderStatic(
        array $arguments,
        Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): string {
        $input = $arguments['input'] ?: '-';
        $separator = $arguments['separator'] ?: '-';

        return self::createSlug($input, $separator);
    }

    /**
     * Creates a slug from an input.
     *
     * @param string $input The input to create a slug from
     * @param string $separator The optional separator, defaults to `-`
     * @param array $rulesets The optional rulesets, defaults to `SlugViewHelper::RULESETS`
     * @return string The slug
     */
    protected static function createSlug(string $input, string $separator = '-', array $rulesets = self::RULESETS): string
    {
        return (new Slugify(['separator' => $separator, 'rulesets' => $rulesets]))->slugify($input);
    }
}
