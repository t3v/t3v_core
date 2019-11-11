<?php
namespace T3v\T3vCore\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController as ActionControllerExtbase;

/**
 * The abstract action controller class.
 *
 * @package T3v\T3vCore\Controller
 */
abstract class AbstractActionController extends ActionControllerExtbase {
  /**
   * Assigns the arguments from the original request.
   */
  protected function assignOriginalArguments(): void {
    $originalRequest = $this->request->getOriginalRequest();

    if (!empty($originalRequest)) {
      $originalArguments = $originalRequest->getArguments();

      $this->view->assign('originalArguments', $originalArguments);
    }
  }
}
