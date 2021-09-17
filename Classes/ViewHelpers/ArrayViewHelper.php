<?php
namespace T3v\T3vCore\ViewHelpers;

use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;

/**
 * The array view helper class.
 *
 * @package T3v\T3vCore\ViewHelpers
 */
class ArrayViewHelper extends AbstractViewHelper
{
    /**
     * Initializes the arguments.
     */
    public function initializeArguments(): void
    {
        parent::initializeArguments();

        $this->registerArgument('array', 'array', 'The array', true);
        $this->registerArgument('key', 'string', 'The key', true);
    }

    /**
     * The view helper render static function.
     *
     * @param array $arguments The arguments
     * @param \Closure $renderChildrenClosure The render children closure
     * @param RenderingContextInterface $renderingContext The rendering context
     * @return object|null The value for the key or null if the key does not exist
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext): ?object
    {
        $result = null;
        $array = $arguments['array'];
        $key = $arguments['key'];

        if (is_array($array) && $key && array_key_exists($key, $array)) {
            $result = $array[$key];
        }

        return $result;
    }
}
