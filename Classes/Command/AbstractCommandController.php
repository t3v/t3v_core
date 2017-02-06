<?php
namespace T3v\T3vCore\Command;

use \TYPO3\CMS\Extbase\Mvc\Controller\CommandController;

use Colors\Color;

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
   * @param string $color The optional color or status, defaults to `white`
   * @return void
   */
  protected function log($message, $color = 'white') {
    $message = (string) $message;
    $color   = (string) $color;

    if ($message) {
      $colorize = new Color();

      switch(true) {
        case ($color === 'info' || $color === 'blue'):
          echo $colorize($message)->blue() . PHP_EOL;

          break;

        case ($color === 'error' || $color === 'red'):
          echo $colorize($message)->red() . PHP_EOL;

          break;

        case ($color === 'warning' || $color === 'yellow'):
          echo $colorize($message)->yellow() . PHP_EOL;

          break;

        case ($color === 'ok' || $color === 'green'):
          echo $colorize($message)->green() . PHP_EOL;

          break;

        default:
          echo $colorize($message)->white() . PHP_EOL;
      }
    }
  }
}