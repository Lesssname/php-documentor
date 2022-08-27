<?php
declare(strict_types=1);

namespace LessDocumentor\Type\Document;

/**
 * @psalm-immutable
 */
final class StringTypeDocument extends AbstractTypeDocument
{
    public function __construct(
        public readonly String\Length $length,
        public readonly ?string $format = null,
        ?string $reference = null,
        ?string $description = null,
        ?string $deprecated = null,
    ) {
        parent::__construct($reference, $description, $deprecated);
    }
}
