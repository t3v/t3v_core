<?php
namespace T3v\T3vCore\ViewHelpers;

use T3v\T3vCore\Service\LocalizationService;
use T3v\T3vCore\Service\PageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;

/**
 * The page view helper class.
 *
 * @package T3v\T3vCore\ViewHelpers
 */
class PageViewHelper extends AbstractViewHelper
{

    /**
     * Initializes the arguments.
     */
    public function initializeArguments(): void
    {
        parent::initializeArguments();

        $this->registerArgument('uid', 'int', 'The UID of the page', true, null);
        $this->registerArgument('languageUid', 'int', 'The optional language UID', false, null);
    }

    /**
     * The view helper render static function.
     *
     * @param array $arguments The arguments
     * @param \Closure $renderChildrenClosure The render children closure
     * @param RenderingContextInterface $renderingContext The rendering context
     * @return array The page object
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        $uid = (int)$arguments['uid'];
        $languageUid = isset($arguments['languageUid']) ? (int)$arguments['languageUid'] : self::getLocalizationService()->getLanguageUid();

        return self::getPageService()->getPageByUid($uid, $languageUid);
    }

    /**
     * Gets the page service.
     *
     * @return \T3v\T3vCore\Service\PageService The page service
     * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
     */
    protected static function getPageService(): PageService
    {
        return GeneralUtility::makeInstance(PageService::class);
    }

    /**
     * Gets the localization service.
     *
     * @return \T3v\T3vCore\Service\LocalizationService The localization service
     * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
     */
    protected static function getLocalizationService(): LocalizationService
    {
        return GeneralUtility::makeInstance(LocalizationService::class);
    }
}
