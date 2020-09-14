<?php
declare(strict_types=1);

namespace T3v\T3vCore\Command;

use Colors\Color;
use Symfony\Component\Console\Command\Command;

/**
 * The abstract command class.
 *
 * @package T3v\T3vCore\Command
 */
abstract class AbstractCommand extends Command
{
    /**
     * Logs respectively echos a message.
     *
     * @param string $message The message to log
     * @param string $color The optional color or status, defaults to `white`
     * @param bool $verbose The optional verbosity, defaults to `false`
     */
    protected function log(string $message, string $color = 'white', bool $verbose = false): void
    {
        if (!empty($message) && $verbose) {
            $c = new Color($message);

            switch (true) {
                case ($color === 'info' || $color === 'blue'):
                    echo $c->blue . PHP_EOL;

                    break;

                case ($color === 'ok' || $color === 'green'):
                    echo $c->green . PHP_EOL;

                    break;

                case ($color === 'warning' || $color === 'yellow'):
                    echo $c->yellow . PHP_EOL;

                    break;

                case ($color === 'error' || $color === 'red'):
                    echo $c->red . PHP_EOL;

                    break;

                default:
                    echo $c->white . PHP_EOL;
            }
        }
    }
}
