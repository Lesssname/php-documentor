<?php
declare(strict_types=1);

namespace LessDocumentor\Type\Document;

/**
 * @psalm-immutable
 */
final class AnyTypeDocument extends AbstractTypeDocument
{
    public function __construct(?string $reference = null, ?string $description = null)
    {
        parent::__construct($reference, $description);

        $this->nullable = true;
    }
}
