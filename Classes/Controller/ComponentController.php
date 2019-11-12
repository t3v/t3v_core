<?php
namespace T3v\T3vCore\Controller;

use TYPO3\CMS\Extbase\Configuration\ConfigurationManager;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\ViewInterface;

/**
 * The component controller class.
 *
 * @package T3v\T3vCore\Controller
 */
class ComponentController extends ActionController {
  /**
   * The configuration manager.
   *
   * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManager
   */
  protected $configurationManager;

  /**
   * Injects the configuration manager.
   *
   * @param \TYPO3\CMS\Extbase\Configuration\ConfigurationManager $configurationManager The configuration manager
   */
  public function injectConfigurationManager(ConfigurationManager $configurationManager): void {
    $this->configurationManager = $configurationManager;
  }

  /**
   * Initialises a view.
   *
   * @param \TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view The view
   */
  protected function initializeView(ViewInterface $view): void {
    $data = $this->configurationManager->getContentObject()->data;

    $this->view->assign('data', $data);
  }
}
