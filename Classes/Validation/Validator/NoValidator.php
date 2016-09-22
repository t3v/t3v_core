<?php
namespace T3v\T3vCore\Validation\Validator;

use \T3v\T3vCore\Validation\Validator\AbstractValidator;

/**
 * No Validator Class
 *
 * @package T3v\T3vCore\Validation\Validator
 */
class NoValidator extends AbstractValidator {
  /**
   * Function to check if the object is valid.
   *
   * @param object $object The object to validate
   * @return boolean If the object is valid, returns always true
   */
  public function isValid($object) {
    return true;
  }
}