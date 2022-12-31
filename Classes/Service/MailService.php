<?php
declare(strict_types=1);

namespace T3v\T3vCore\Service;

use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MailUtility;

/**
 * The mail service class.
 *
 * @package T3v\T3vCore\Service
 */
class MailService extends AbstractService
{
    /**
     * Sends a mail.
     *
     * @param array $from The sender of the message, an array consisting of a `name` and `address` key / value pair, the `name` entry is optional and can be omitted
     * @param array $to The recipient(s), an array consisting of `name` and `address` key / value pairs, the `name` entry is optional and can be omitted
     * @param array $cc The recipient(s) who will be copied in on the message, an array consisting of `name` and `address` key / value pairs, the `name` entry is optional and can be omitted
     * @param array $replyTo The optional reply-to addresses of the message, an array consisting of `name` and `address` key / value pairs, the `name` entry is optional and can be omitted
     * @param string $subject The subject
     * @param string $message The message
     * @param string $format The optional format either `text/html` or `text/plain`, defaults to `text/html`
     * @return bool If the mail was sent
     */
    public function send(
        array $from,
        array $to,
        array $cc,
        array $replyTo,
        string $subject,
        string $message,
        string $format = 'text/html'
    ): bool {
        $mail = GeneralUtility::makeInstance(MailMessage::class);

        // === From ===

        if (!empty($from)) {
            $name = trim($from['name']);
            $address = trim($from['address']);

            if ($address && GeneralUtility::validEmail($address)) {
                if (!empty($name)) {
                    $mail->setFrom([$address => $name]);
                } else {
                    $mail->setFrom($address);
                }
            } else {
                return false;
            }
        } else {
            $systemFrom = MailUtility::getSystemFrom();

            $mail->setFrom($systemFrom);
        }

        // === To / Carbon Copy (CC) ===

        $toRecipients = [];
        $ccRecipients = [];

        if (!empty($to)) {
            $recipients = [];

            foreach ($to as $recipient) {
                $address = trim($recipient['address']);

                if ($address && GeneralUtility::validEmail($address)) {
                    $recipients[] = $recipient;
                }
            }

            foreach ($recipients as $i => $recipient) {
                $name = trim($recipient['name']);
                $address = trim($recipient['address']);

                if ($i === 0) { // Adds the first recipient to `To`:
                    if (!empty($name)) {
                        $toRecipients[$address] = $name;
                    } else {
                        $toRecipients[] = $address;
                    }
                } elseif (!empty($name)) { // Adds the other recipients to `Cc`:
                    $ccRecipients[$address] = $name;
                } else {
                    $ccRecipients[] = $address;
                }
            }
        }

        if (!empty($toRecipients)) {
            $mail->setTo($toRecipients);
        } else {
            return false;
        }

        if (!empty($cc)) {
            foreach ($cc as $recipient) {
                $name = trim($recipient['name']);
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

        if (!empty($ccRecipients)) {
            $mail->setCc($ccRecipients);
        }

        // === Reply To ===

        $replyToRecipients = [];

        if (!empty($replyTo)) {
            foreach ($replyTo as $recipient) {
                $name = trim($recipient['name']);
                $address = trim($recipient['address']);

                if ($address && GeneralUtility::validEmail($address)) {
                    if (!empty($name)) {
                        $replyToRecipients[$address] = $name;
                    } else {
                        $replyToRecipients[] = $address;
                    }
                }
            }
        }

        if (!empty($replyToRecipients)) {
            $mail->setReplyTo($replyToRecipients);
        }

        // === Subject ===

        if (!empty($subject)) {
            $mail->setSubject($subject);
        } else {
            return false;
        }

        // === Message ===

        if (!empty($message)) {
            switch ($format) {
                case 'text/html':
                    $mail->setBody()->html($message);

                    break;

                case 'text/plain':
                    $mail->setBody()->text($message);

                    break;
            }
        } else {
            return false;
        }

        // === Mail shipping ===

        $mail->send();

        return $mail->isSent();
    }
}
