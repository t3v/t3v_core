<?php
declare(strict_types=1);

namespace T3v\T3vCore\Validation\Validator;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Extbase\Validation\Error;
use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator as ExtbaseAbstractValidator;

/**
 * The abstract validator class.
 *
 * @package T3v\T3vCore\Validation\Validator
 */
abstract class AbstractValidator extends ExtbaseAbstractValidator
{
    /**
     * Adds an error to a property.
     *
     * @param string $property The property
     * @param string $key The key to reference the error
     * @param string $extensionName The extension name
     */
    protected function addErrorToProperty(string $property, string $key, string $extensionName): void
    {
        $errorMessage = LocalizationUtility::translate($key, $extensionName);
        $error = GeneralUtility::makeInstance(Error::class, $errorMessage, time());

        $this->result->forProperty($property)->addError($error);
    }
}
