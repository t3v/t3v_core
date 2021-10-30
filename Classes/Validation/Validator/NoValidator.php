<?php
namespace T3v\T3vCore\Validation\Validator;

/**
 * The no validator class.
 *
 * @package T3v\T3vCore\Validation\Validator
 * @deprecated Use `T3v\T3vBase\Validation\Validator\NoValidator` instead will be removed in the next major version.
 */
class NoValidator extends AbstractValidator
{
    /**
     * Checks if a value is valid, returns always true.
     *
     * @param object $value The value to validate
     * @return bool If the value is valid, returns always true
     */
    public function isValid($value): bool
    {
        return true;
    }
}
