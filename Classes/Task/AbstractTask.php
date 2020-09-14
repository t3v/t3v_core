<?php
declare(strict_types=1);

namespace T3v\T3vCore\Task;

use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Core\Messaging\FlashMessage;
use TYPO3\CMS\Core\Messaging\FlashMessageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Scheduler\Task\AbstractTask as TYPO3AbstractTask;

abstract class AbstractTask extends TYPO3AbstractTask
{

    /**
     * Shows a flash message.
     *
     * @param string $description The description of the flash message
     * @param string $title The optional title of the flash message, defaults to ``
     * @param int $severity The optional severity, defaults to `FlashMessage::INFO`
     * @param bool $storeInSession Defines whether the message should be stored in the session or only for one request (default)
     * @param bool $enableLogging Enable logging, defaults to `false`
     */
    protected function showFlashMessage(
        string $description,
        string $title = '',
        int $severity = FlashMessage::INFO,
        bool $storeInSession = false,
        bool $enableLogging = false
    ): void {
        $message = GeneralUtility::makeInstance(
            FlashMessage::class,
            $description,
            $title,
            $severity,
            $storeInSession
        );

        $flashMessageService = GeneralUtility::makeInstance(FlashMessageService::class);
        $defaultFlashMessageQueue = $flashMessageService->getMessageQueueByIdentifier();

        try {
            $defaultFlashMessageQueue->enqueue($message);

            if ($enableLogging === true) {
                $this->scheduler->log($description, 0);
            }
        } catch (Exception $exception) {
            if ($enableLogging === true) {
                $this->scheduler->log($exception->getMessage(), 1);
            }
        }
    }
}
