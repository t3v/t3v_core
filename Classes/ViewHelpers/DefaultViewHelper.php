<?php
namespace T3v\T3vCore\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;

/**
 * The default view helper class.
 *
 * @package T3v\T3vCore\ViewHelpers
 */
class DefaultViewHelper extends AbstractViewHelper
{
    /**
     * Initializes the arguments.
     */
    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('value', 'string', 'The value', false, null);
        $this->registerArgument('default', 'string', 'The default value, defaults to `-`', false, '-');
    }

    /**
     * The view helper render static function.
     *
     * @param array $arguments The arguments
     * @param \Closure $renderChildrenClosure The render children closure
     * @param RenderingContextInterface $renderingContext The rendering context
     * @return string The value if available, otherwise the default one
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ): string {
        return $arguments['value'] ?: $arguments['default'];
    }
}
