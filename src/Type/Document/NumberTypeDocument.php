<?php
declare(strict_types=1);

namespace LessDocumentor\Type\Document;

/**
 * @psalm-immutable
 */
final class NumberTypeDocument extends AbstractTypeDocument
{
    /**
     * @param class-string $reference
     */
    public function __construct(
        public readonly Property\Range $range,
        public readonly int $precision,
        ?string $reference = null,
        ?string $description = null,
        ?string $deprecated = null,
    ) {
        parent::__construct($reference, $description, $deprecated);
    }
}
