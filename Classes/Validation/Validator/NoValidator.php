<?php
namespace T3v\T3vCore\Validation\Validator;

/**
 * The no validator class.
 *
 * @package T3v\T3vCore\Validation\Validator
 */
class NoValidator extends AbstractValidator
{
  /**
   * Checks if the value is valid, always returns true.
   *
   * @param mixed $value The value to validate
   * @return bool Always returns true
   */
  public function isValid($value): bool {
    return true;
  }
}
