<?php

namespace tests;

use PHPUnit\Framework\TestCase;
use Validator\Attribute\NotNull;
use Validator\Validator;

/**
 * @internal
 */
class NotNullTests extends TestCase
{
    public function testSimpleNotNull(): void
    {
        $dummy = new Dummy('test', 1);
        $errors = Validator::validate($dummy);
        static::assertEmpty($errors);
    }

    public function testSimpleNull(): void
    {
        $dummy = new Dummy(null, null);
        $errors = Validator::validate($dummy);
        static::assertNotEmpty($errors);
        static::assertEquals('The name should not be null', $errors[0]);
        static::assertNotNull($errors[1]);
    }
}

class Dummy
{
    #[NotNull('name', 'The {{PROPERTY}} should not be null')]
    public ?string $name;
    #[NotNull('age')]
    public ?int $age;

    public function __construct(?string $name, ?int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }
}
