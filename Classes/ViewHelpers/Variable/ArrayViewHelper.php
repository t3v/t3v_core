<?php
declare(strict_types=1);

namespace T3v\T3vCore\ViewHelpers\Variable;

use Closure;
use T3v\T3vCore\ViewHelpers\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;

/**
 * The array view helper class.
 *
 * @package T3v\T3vCore\ViewHelpers\Variable
 * @deprecated Use `T3v\T3vBase\ViewHelpers\Variable\ArrayViewHelper` instead, will be removed in a next major version.
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
     * @param Closure $renderChildrenClosure The render children closure
     * @param RenderingContextInterface $renderingContext The rendering context
     * @return mixed The value for the key or null if the key does not exist
     */
    public static function renderStatic(array $arguments, Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
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
