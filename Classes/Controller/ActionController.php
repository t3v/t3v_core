<?php
namespace T3v\T3vCore\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController as ActionControllerExtbase;

/**
 * The action controller class.
 *
 * @package T3v\T3vCore\Controller
 */
class ActionController extends ActionControllerExtbase {
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
