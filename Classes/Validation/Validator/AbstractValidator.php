<?php
namespace T3v\T3vCore\Validation\Validator;

use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Extbase\Validation\Error;
use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator as AbstractValidatorExtbase;

/**
 * The abstract validator class.
 *
 * @package T3v\T3vCore\Validation\Validator
 */
abstract class AbstractValidator extends AbstractValidatorExtbase {
  /**
   * The object manager.
   *
   * @var \TYPO3\CMS\Extbase\Object\ObjectManager
   * @inject
   */
  protected $objectManager;

  /**
   * Adds an error to a property.
   *
   * @param string $property The property
   * @param string $key The key to reference the error
   * @param string $extensionName The extension name
   * @return void
   */
  protected function addErrorToProperty($property, $key, $extensionName) {
    $errorMessage = LocalizationUtility::translate($key, $extensionName);
    $error        = $this->objectManager->get(Error::class, $errorMessage, time());

    $this->result->forProperty($property)->addError($error);
  }
}