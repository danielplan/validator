<?php

namespace Validator\Attribute;

use Attribute;
use Sprog\Wildcard;

#[Attribute(Attribute::TARGET_PROPERTY)]
abstract class Validation
{
    public string $errorMessage;
    public string $fieldName;

    public function __construct(
        string $fieldName,
        string $errorMsg,
    ) {
        $this->errorMessage = Wildcard::get($errorMsg) ?? $errorMsg;
        $this->fieldName = Wildcard::get($fieldName) ?? $fieldName;
    }

    abstract public function validate(mixed $value): bool;
}
