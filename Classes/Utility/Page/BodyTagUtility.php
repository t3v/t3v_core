<?php
declare(strict_types=1);

namespace T3v\T3vCore\Utility\Page;

use T3v\T3vCore\Service\PageService;
use T3v\T3vCore\Utility\AbstractUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The body tag utility class.
 *
 * @package T3v\T3vCore\Utility\Page
 */
class BodyTagUtility extends AbstractUtility
{
    /**
     * The default body CSS class.
     */
    public const DEFAULT_BODY_CSS_CLASS = 'body';

    /**
     * Builds a body tag.
     *
     * @param string $bodyCssClass The CSS class of the body tag, defaults to `BodyTagUtility::DEFAULT_BODY_CSS_CLASS`
     * @return string The body tag
     * @throws \Exception
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function build(string $bodyCssClass = self::DEFAULT_BODY_CSS_CLASS): string
    {
        $pageService = GeneralUtility::makeInstance(PageService::class);
        $page = $pageService->getCurrentPage();
        $backendLayout = $pageService->getBackendLayoutForPage($page['uid']);

        if (!empty($backendLayout)) {
            $bodyCssClass = "{$backendLayout} {$bodyCssClass}";
        }

        return '<body class="' . $bodyCssClass . '">';
    }
}
