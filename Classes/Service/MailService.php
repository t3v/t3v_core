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
    $subject = (string) $subject;
    $message = (string) $message;
    $format  = (string) $format;

    $mail = $this->objectManager->get('TYPO3\CMS\Core\Mail\MailMessage');

    // === From ===

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

    // === To / Cc ===

    $toRecipients = [];
    $ccRecipients = [];

    if (is_array($to)) {
      $recipients = [];

      foreach ($to as $recipient) {
        $name    = trim($recipient['name']);
        $address = trim($recipient['address']);

        if ($address && GeneralUtility::validEmail($address)) {
          $recipients[] = $recipient;
        }
      }

      for ($i = 0; $i < count($recipients); $i++) {
        $recipient = $recipients[$i];
        $name      = trim($recipient['name']);
        $address   = trim($recipient['address']);

        if ($i == 0) { // First recipient
          // Add first recipient to `To`
          if (!empty($name)) {
            $toRecipients[$address] = $name;
          } else {
            $toRecipients[] = $address;
          }
        } else { // Other recipients
          // Add other recipients to `Cc`
          if (!empty($name)) {
            $ccRecipients[$address] = $name;
          } else {
            $ccRecipients[] = $address;
          }
        }
      }
    }

    if (count($toRecipients)) {
      $mail->setTo($toRecipients);
    } else {
      return false;
    }

    if (is_array($cc)) {
      foreach ($cc as $recipient) {
        $name    = trim($recipient['name']);
        $address = trim($recipient['address']);

        if ($address && GeneralUtility::validEmail($address)) {
          if (!empty($name)) {
            $ccRecipients[$address] = $name;
          } else {
            $ccRecipients[] = $address;
          }
        }
      }
    }

    if (count($ccRecipients)) {
      $mail->setCc($ccRecipients);
    }

    // === Subject ===

    if (!empty($subject)) {
      $mail->setSubject($subject);
    } else {
      return false;
    }

    // === Message ===

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