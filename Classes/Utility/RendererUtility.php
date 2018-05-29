<?php
namespace T3v\T3vCore\Utility;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

use T3v\T3vCore\Utility\AbstractUtility;

/**
 * The renderer utility class.
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
   * Gets Fluid renderer for a template.
   *
   * @param string $template The template
   * @param string $format The optional format, `html` is used as default
   * @return object The renderer for the template
   */
  public function getFluidRendererForTemplate(string $template, string $format = 'html') {
    $configurationManager = $this->objectManager->get(ConfigurationManagerInterface::class);
    $configuration        = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
    $layoutRootPath       = $configuration['view']['layoutRootPath'];

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

    $renderer = $this->objectManager->get(StandaloneView::class);
    $renderer->setLayoutRootPaths([$layoutRootPath]);
    $renderer->setPartialRootPaths([$partialRootPath]);
    $renderer->setTemplatePathAndFilename($templateRootPath . $template);
    $renderer->setFormat($format);

    return $renderer;
  }
}