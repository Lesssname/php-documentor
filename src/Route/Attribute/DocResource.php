<?php
declare(strict_types=1);

namespace LessDocumentor\Route\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
final class DocResource
{
    /**
     * @param class-string $resource
     */
    public function __construct(public readonly string $resource)
    {}
}