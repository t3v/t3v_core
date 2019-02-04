<?php
namespace T3v\T3vCore\Validation\Validator;

use T3v\T3vCore\Validation\Validator\AbstractValidator;

/**
 * The no validator class.
 *
 * @package T3v\T3vCore\Validation\Validator
 */
class NoValidator extends AbstractValidator {
  /**
   * Checks if object is valid.
   *
   * @param object $object The object to validate
   * @return bool If the object is valid, returns always true
   */
  public function isValid($object): bool {
    return true;
  }
}
