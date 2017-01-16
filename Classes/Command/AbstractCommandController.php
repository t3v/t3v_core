<?php
namespace T3v\T3vCore\Command;

use \TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

/**
 * Abstract Command Controller Class
 *
 * @package T3v\T3vCore\Command
 */
abstract class AbstractCommandController extends CommandController {
  /**
   * Helper function to log a message.
   *
   * @param string $message The message
   * @return void
   */
  protected function log($message) {
    if ($message) {
      echo("{$message}\n");
    }
  }
}