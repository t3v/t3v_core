<?php
declare(strict_types=1);

namespace T3v\T3vCore\ViewHelpers\Page;

use T3v\T3vCore\ViewHelpers\AbstractViewHelper;
use T3v\T3vCore\ViewHelpers\Traits\LocalizationTrait;

/**
 * The language view helper class.
 *
 * @package T3v\T3vCore\ViewHelpers\Page
 */
class LanguageViewHelper extends AbstractViewHelper
{
    /**
     * Use the localization trait.
     */
    use LocalizationTrait;

    /**
     * Initializes the arguments.
     */
    public function initializeArguments(): void
    {
        parent::initializeArguments();

        $this->registerArgument('default', 'string', 'The default language, defaults to `en`', false, 'en');
    }

    /**
     * The view helper render function.
     *
     * @return string The language of the current page if available, otherwise the default one
     */
    public function render(): string
    {
        $language = $this->getLanguage();

        return $language ?: $this->arguments['default'];
    }
}
