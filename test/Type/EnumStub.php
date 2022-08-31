<?php
// phpcs:ignoreFile enum
declare(strict_types=1);

namespace LessDocumentorTest\Type;

use LessValueObject\Enum\EnumValueObject;

/**
 * @psalm-immutable
 */
enum EnumStub: string implements EnumValueObject
{
    case Foo = 'foo';
    case Fiz = 'fiz';

    public function jsonSerialize(): string
    {
        return $this->value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
