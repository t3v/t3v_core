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
   * Checks if the object is valid.
   *
   * @param object $object The object to validate
   * @return boolean If the object is valid, returns always true
   */
  public function isValid($object) {
    return true;
  }
}