<?php
declare(strict_types=1);

namespace T3v\T3vCore\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Object\Exception;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * The renderer utility class.
 *
 * @package T3v\T3vCore\Utility
 */
class RendererUtility extends AbstractUtility
{
    /**
     * Gets a Fluid renderer for a template.
     *
     * @param string $template The template
     * @param string $format The optional format, `html` is used as default
     * @return StandaloneView The renderer for the template
     * @throws Exception
     */
    public function getFluidRendererForTemplate(string $template, string $format = 'html'): StandaloneView
    {
        $configurationManager = self::getConfigurationManager();
        $configuration = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);

        $layoutRootPath = $configuration['view']['layoutRootPath'];

        if (empty($layoutRootPath)) {
            $firstLayoutRootPath = reset($configuration['view']['layoutRootPaths']);

            $layoutRootPath = GeneralUtility::getFileAbsFileName($firstLayoutRootPath);
        } else {
            $layoutRootPath = GeneralUtility::getFileAbsFileName($layoutRootPath);
        }

        $templateRootPath = $configuration['view']['templateRootPath'];

        if (empty($templateRootPath)) {
            $firstTemplateRootPath = reset($configuration['view']['templateRootPaths']);

            $templateRootPath = GeneralUtility::getFileAbsFileName($firstTemplateRootPath);
        } else {
            $templateRootPath = GeneralUtility::getFileAbsFileName($templateRootPath);
        }

        $partialRootPath = $configuration['view']['partialRootPath'];

        if (empty($partialRootPath)) {
            $firstPartialRootPath = reset($configuration['view']['partialRootPaths']);

            $partialRootPath = GeneralUtility::getFileAbsFileName($firstPartialRootPath);
        } else {
            $partialRootPath = GeneralUtility::getFileAbsFileName($partialRootPath);
        }

        $renderer = GeneralUtility::makeInstance(StandaloneView::class);
        $renderer->setLayoutRootPaths([$layoutRootPath]);
        $renderer->setPartialRootPaths([$partialRootPath]);
        $renderer->setTemplatePathAndFilename($templateRootPath . $template);
        $renderer->setFormat($format);

        return $renderer;
    }
}
