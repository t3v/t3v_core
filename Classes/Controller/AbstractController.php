<?php
namespace T3v\T3vCore\Controller;

use TYPO3\CMS\Core\Messaging\AbstractMessage;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Abstract Controller Class
 *
 * @package T3v\T3vCore\Controller
 */
abstract class AbstractController extends ActionController {
  /**
   * Pattern after which the view object name is built if no Fluid template is found.
   *
   * @var string
   */
  protected $viewObjectNamePattern = '@vendor\@extension\View\@controller\@action@format';

  /**
   * Helper to recover and assign the arguments from the original request.
   *
   * @return void
   */
  protected function assignOriginalArguments() {
    $originalRequest = $this->request->getOriginalRequest();

    if (!empty($originalRequest)) {
      $originalArguments = $originalRequest->getArguments();

      $this->view->assign('originalArguments', $originalArguments);
    }
  }

  /**
   * Overrides the error flash message getter.
   *
   * @return false
   */
  protected function getErrorFlashMessage() {
    return false;
  }
}