<?php
namespace T3v\T3vCore\Service;

use \TYPO3\CMS\Core\Mail\MailMessage;
use \TYPO3\CMS\Core\Utility\GeneralUtility;

use \T3v\T3vCore\Service\AbstractService;

/**
 * Mail Service Class
 *
 * @package T3v\T3vCore\Service
 */
class MailService extends AbstractService {
  /**
   * The constructor function.
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * Sends a mail.
   *
   * @param array $from The sender
   * @param array $to The recipient(s)
   * @param array $cc The recipient(s) who will be copied in on the message
   * @param string $subject The subject
   * @param string $message The message
   * @param string $format The optional format either `text/plain` or `text/html`, defaults to `text/plain`
   * @return boolean If the mail was sent
   */
  public function send($from, $to, $cc, $subject, $message, $format = 'text/plain') {
    $mail = $this->objectManager->get('TYPO3\CMS\Core\Mail\MailMessage');

    // === Built `from` ===

    if ($from) {
      $name    = trim($from['name']);
      $address = trim($from['address']);

      if ($address && GeneralUtility::validEmail($address)) {
        if (!empty($name)) {
          $mail->setFrom(array($address => $name));
        } else {
          $mail->setFrom($address);
        }
      } else {
        return false;
      }
    }

    // === Built `to` ===

    $recipients = array();

    if (is_array($to)) {
      foreach ($to as $pair) {
        $name    = trim($pair['name']);
        $address = trim($pair['address']);

        if ($address && GeneralUtility::validEmail($address)) {
          if (!empty($name)) {
            $recipients[$address] = $name;
          } else {
            $recipients[] = $address;
          }
        }
      }
    }

    if (count($recipients)) {
      $mail->setTo($recipients);
    } else {
      return false;
    }

    // === Built `cc` ===

    $recipients = array();

    if (is_array($cc)) {
      foreach ($cc as $pair) {
        $name    = trim($pair['name']);
        $address = trim($pair['address']);

        if ($address && GeneralUtility::validEmail($address)) {
          if (!empty($name)) {
            $recipients[$address] = $name;
          } else {
            $recipients[] = $address;
          }
        }
      }
    }

    if (count($recipients)) {
      $mail->setCc($recipients);
    }

    // === Built `subject` ===

    if (!empty($subject)) {
      $mail->setSubject($subject);
    } else {
      return false;
    }

    // === Built `message` ===

    if (!empty($message)) {
      $mail->setBody($message, $format);
    } else {
      return false;
    }

    // === Mail shipping ===

    $mail->send();

    return $mail->isSent();
  }
}