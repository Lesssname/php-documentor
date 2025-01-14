<?php
declare(strict_types=1);

namespace LessDocumentor\Type\Document\Composite;

use LessDocumentor\Type\Document\TypeDocument;

/**
 * @psalm-immutable
 */
final class Property
{
    /**
     * @param object|string|int|bool|null|array<mixed>|float $default
     */
    public function __construct(
        public readonly TypeDocument $type,
        public readonly bool $required = true,
        public readonly object|string|int|bool|null|array|float $default = null,
        public readonly bool $deprecated = false,
    ) {}
}
