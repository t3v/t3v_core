<?php
namespace T3v\T3vCore\Command;

use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

use Colors\Color;

/**
 * The abstract command controller class.
 *
 * @package T3v\T3vCore\Command
 */
abstract class AbstractCommandController extends CommandController {
  /**
   * Logs a message.
   *
   * @param string $message The message
   * @param string $color The optional color or status, defaults to `white`
   * @return void
   */
  protected function log($message, $color = 'white') {
    $message = (string) $message;
    $color   = (string) $color;

    if ($message) {
      $message = new Color($message);

      switch(true) {
        case ($color === 'info' || $color === 'blue'):
          echo $message->blue . PHP_EOL;

          break;

        case ($color === 'error' || $color === 'red'):
          echo $message->red . PHP_EOL;

          break;

        case ($color === 'warning' || $color === 'yellow'):
          echo $message->yellow . PHP_EOL;

          break;

        case ($color === 'ok' || $color === 'green'):
          echo $message->green . PHP_EOL;

          break;

        default:
          echo $message->white . PHP_EOL;
      }
    }
  }
}