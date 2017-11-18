<?php
namespace T3v\T3vCore\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

use T3v\T3vCore\Utility\AbstractUtility;

/**
 * Renderer Utility Class
 *
 * @package T3v\T3vCore\Utility
 */
class RendererUtility extends AbstractUtility {
  /**
   * The constructor function.
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * Gets a Fluid renderer for a template.
   *
   * @param string $template The template
   * @param string $format The optional format, `html` is used as default
   * @return object The renderer for the template
   */
  public function getFluidRendererForTemplate($template, $format = 'html') {
    $template = (string) $template;
    $format   = (string) $format;

    $configurationManager = $this->objectManager->get(ConfigurationManagerInterface::class);
    $configuration        = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);

    $layoutRootPath = GeneralUtility::getFileAbsFileName($configuration['view']['layoutRootPath']);

    if (empty($layoutRootPath)) {
      $firstLayoutRootPath = reset($configuration['view']['layoutRootPaths']);

      $layoutRootPath = GeneralUtility::getFileAbsFileName($firstLayoutRootPath);
    }

    $templateRootPath = GeneralUtility::getFileAbsFileName($configuration['view']['templateRootPath']);

    if (empty($templateRootPath)) {
      $firstTemplateRootPath = reset($configuration['view']['templateRootPaths']);

      $templateRootPath = GeneralUtility::getFileAbsFileName($firstTemplateRootPath);
    }

    $partialRootPath = GeneralUtility::getFileAbsFileName($configuration['view']['partialRootPath']);

    if (empty($partialRootPath)) {
      $firstPartialRootPath = reset($configuration['view']['partialRootPaths']);

      $partialRootPath = GeneralUtility::getFileAbsFileName($firstPartialRootPath);
    }

    $renderer = $this->objectManager->get(StandaloneView::class);
    $renderer->setLayoutRootPaths([$layoutRootPath]);
    $renderer->setPartialRootPaths([$partialRootPath]);
    $renderer->setTemplatePathAndFilename($templateRootPath . $template);
    $renderer->setFormat($format);

    return $renderer;
  }
}