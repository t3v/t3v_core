<?php
namespace T3v\T3vCore\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\CommandController as CommandControllerExtbase;

use Colors\Color;

/**
 * The abstract command controller class.
 *
 * @package T3v\T3vCore\Controller
 */
abstract class AbstractCommandController extends CommandControllerExtbase {
  /**
   * Logs respectively echos a message.
   *
   * @param string $message The message to log
   * @param string $color The optional color or status, defaults to `white`
   * @param bool $verbose The optional verbosity, defaults to `false`
   */
  protected function log(string $message, string $color = 'white', bool $verbose = false) {
    if ($message && $verbose) {
      $message = new Color($message);

      switch(true) {
        case ($color === 'info' || $color === 'blue'):
          echo $message->blue . PHP_EOL;

          break;

        case ($color === 'ok' || $color === 'green'):
          echo $message->green . PHP_EOL;

          break;

        case ($color === 'warning' || $color === 'yellow'):
          echo $message->yellow . PHP_EOL;

          break;

        case ($color === 'error' || $color === 'red'):
          echo $message->red . PHP_EOL;

          break;

        default:
          echo $message->white . PHP_EOL;
      }
    }
  }
}
