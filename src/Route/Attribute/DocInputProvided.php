<?php
declare(strict_types=1);

namespace LessDocumentor\Route\Attribute;

use Attribute;

/**
 * Attribute to mark specified keys as internal provided
 */
#[Attribute(Attribute::TARGET_CLASS)]
final class DocInputProvided
{
    /**
     * @param array<string> $keys
     */
    public function __construct(public array $keys)
    {}
}
