<?php

namespace Validator\Attribute;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class NotNull extends Validation
{

    public function __construct(string $fieldName, string $errorMsg = 'The {{PROPERTY}} is null')
    {
        parent::__construct($fieldName, $errorMsg);
    }

    public function validate($value): bool
    {
        return $value !== null;
    }
}
