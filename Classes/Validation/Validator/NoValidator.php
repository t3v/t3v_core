<?php
declare(strict_types=1);

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
     * Checks if the value is valid, always returns true.
     *
     * @param mixed $value The value to validate
     * @return bool Always returns true
     */
    public function isValid($value): bool
    {
        return true;
    }
}
