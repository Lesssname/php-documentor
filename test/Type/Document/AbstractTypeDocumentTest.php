<?php
declare(strict_types=1);

namespace LessDocumentorTest\Type\Document;

use LessDocumentor\Type\Document\AbstractTypeDocument;
use PHPUnit\Framework\TestCase;

/**
 * @covers \LessDocumentor\Type\Document\AbstractTypeDocument
 */
final class AbstractTypeDocumentTest extends TestCase
{
    public function testSetup(): void
    {
        $document = $this->getMockForAbstractClass(
            AbstractTypeDocument::class,
            [
                'ref',
                'description',
                null,
            ],
        );

        self::assertSame('ref', $document->getReference());
    }

    public function testWithDescription(): void
    {
        $document = $this->getMockForAbstractClass(
            AbstractTypeDocument::class,
            ['ref'],
        );

        $clone = $document->withDescription('fiz');

        self::assertNull($document->getDescription());
        self::assertNotSame($clone, $document);
        self::assertSame('fiz', $clone->getDescription());
    }
}
