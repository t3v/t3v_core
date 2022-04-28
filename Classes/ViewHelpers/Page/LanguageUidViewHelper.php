<?php
declare(strict_types=1);

namespace T3v\T3vCore\ViewHelpers\Page;

use T3v\T3vCore\ViewHelpers\AbstractViewHelper;
use T3v\T3vCore\ViewHelpers\Traits\LocalizationTrait;
use TYPO3\CMS\Extbase\Object\Exception;

/**
 * The language UID view helper class.
 *
 * @package T3v\T3vCore\ViewHelpers\Page
 * @deprecated Use `T3v\T3vBase\ViewHelpers\Page\LanguageUidViewHelper` instead, will be removed in a next major version.
 */
class LanguageUidViewHelper extends AbstractViewHelper
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

        $this->registerArgument('default', 'int', 'The default language UID, defaults to `0`', false, 0);
    }

    /**
     * The view helper render function.
     *
     * @return int The language UID of the current page if available, otherwise the default one
     * @throws Exception
     */
    public function render(): int
    {
        $languageUid = $this->getLanguageUid();

        return $languageUid ?: $this->arguments['default'];
    }
}
