<?php
declare(strict_types=1);

namespace LessDocumentor\Route\Document;

use LessDocumentor\Type\Document\TypeDocument;
use LessValueObject\Composite\AbstractCompositeValueObject;

/**
 * @psalm-immutable
 */
final class RouteDocument extends AbstractCompositeValueObject
{
    /**
     * @param array<int, Property\Response> $responses
     */
    public function __construct(
        public readonly Property\Method $method,
        public readonly Property\Category $category,
        public readonly Property\Path $path,
        public readonly Property\Resource $resource,
        public readonly ?Property\Deprecated $deprecated,
        public readonly TypeDocument $input,
        public readonly array $responses,
    ) {}
}
