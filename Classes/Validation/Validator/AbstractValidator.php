<?php
namespace T3v\T3vCore\Validation\Validator;

use \TYPO3\CMS\Extbase\Object\ObjectManagerInterface;
use \TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Abstract Validator Class
 *
 * @package T3v\T3vCore\Validation\Validator
 */
abstract class AbstractValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {
  /**
   * @var \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
   * @inject
   */
  protected $objectManager;

  /**
   * Helper function to add an error to a property.
   *
   * @param string $property The property
   * @param string $key The key to reference the error
   * @param string $extensionName The extension name
   * @return void
   */
  protected function addErrorToProperty($property, $key, $extensionName) {
    $errorMessage = LocalizationUtility::translate($key, $extensionName);
    $error        = $this->objectManager->get('TYPO3\CMS\Extbase\Validation\Error', $errorMessage, time());

    $this->result->forProperty($property)->addError($error);
  }
}