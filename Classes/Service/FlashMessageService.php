<?php
namespace T3v\T3vCore\Service;

use \TYPO3\CMS\Core\Messaging\FlashMessage;
use \TYPO3\CMS\Core\Messaging\FlashMessageQueue;
use \TYPO3\CMS\Core\Messaging\FlashMessageService;
use \TYPO3\CMS\Core\Utility\GeneralUtility;

use \T3v\T3vCore\Service\AbstractService;

/**
 * Class FlashMessageService
 *
 * @package T3v\T3vCore\Service
 */
class FlashMessageService extends AbstractService {
  /**
   * @var \TYPO3\CMS\Core\Messaging\FlashMessageService
   */
  protected $flashMessageService;

  /**
   * @var \TYPO3\CMS\Core\Messaging\FlashMessageQueue
   */
  protected $flashMessageQueue;

  /**
   * The constructor function.
   */
  public function __construct() {
    parent::__construct();

    $this->flashMessageService = GeneralUtility::makeInstance('TYPO3\CMS\Core\Messaging\FlashMessageService');
    $this->flashMessageQueue   = $this->flashMessageService->getMessageQueueByIdentifier();
  }

  /**
   * Helper function to add a flash message.
   *
   * @param string $message The message
   * @param \TYPO3\CMS\Core\Messaging\FlashMessage $severity The severity
   * @return mixed
   */
  public function addFlashMessage($message, $severity) {
    if ($this->checkDuplicateFlashMessage($message, $severity)) {
      return;
    }

    switch ($severity) {
      case 'notice':
        $severity = FlashMessage::NOTICE;
        break;
      case 'info':
        $severity = FlashMessage::INFO;
        break;
      case 'ok':
        $severity = FlashMessage::OK;
        break;
      case 'error':
        $severity = FlashMessage::ERROR;
        break;
      default:
        $severity = FlashMessage::WARNING;
        break;
    }

    $flashMessage = GeneralUtility::makeInstance('TYPO3\CMS\Core\Messaging\FlashMessage', htmlspecialchars($message), '', $severity);

    $this->flashMessageQueue->enqueue($flashMessage);
  }

  /**
   * Helper function to get the flash message queue.
   *
   * @return \TYPO3\CMS\Core\Messaging\FlashMessageQueue
   */
  public function getFlashMessageQueue() {
    return $this->flashMessageQueue;
  }

  /**
   * Helper function to check for duplicate flash message.
   *
   * @param string $message The message
   * @param \TYPO3\CMS\Core\Messaging\FlashMessage $severity The severity
   * @return boolean
   */
  protected function checkDuplicateFlashMessage($message, $severity) {
    foreach($this->flashMessageQueue as $flashMessage) {
      if ($flashMessage->getMessage() == $message) {
        return true;
      }
    }

    return false;
  }
}