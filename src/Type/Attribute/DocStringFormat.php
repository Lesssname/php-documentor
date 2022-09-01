<?php
declare(strict_types=1);

namespace LessDocumentor\Type\Attribute;

use Attribute;

/**
 * @psalm-immutable
 *
 * @deprecated use DocFormat
 */
#[Attribute(Attribute::TARGET_CLASS)]
final class DocStringFormat
{
    public function __construct(public readonly string $name)
    {}
}
