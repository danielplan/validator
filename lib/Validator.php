<?php

namespace Validator;

use Validator\Attribute\Validation;

class Validator
{
    public static function validate(object $object): array
    {
        $class = new \ReflectionClass($object);
        $errors = [];
        foreach ($class->getProperties() as $property) {
            foreach ($property->getAttributes(Validation::class, \ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
                $attribute = $attribute->newInstance();
                if (!$attribute->validate($property->getValue($object))) {
                    $errors[] = str_replace('{{PROPERTY}}', $attribute->fieldName, $attribute->errorMessage);
                }
            }
        }
        return $errors;
    }
}
