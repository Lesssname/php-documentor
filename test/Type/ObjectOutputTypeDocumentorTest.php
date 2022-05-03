<?php
declare(strict_types=1);

namespace LessDocumentorTest\Type;

use LessDocumentor\Type\Document\BoolTypeDocument;
use LessDocumentor\Type\Document\CompositeTypeDocument;
use LessDocumentor\Type\ObjectOutputTypeDocumentor;
use LessValueObject\Number\Int\Paginate\PerPage;
use PHPUnit\Framework\TestCase;

/**
 * @covers \LessDocumentor\Type\ObjectOutputTypeDocumentor
 */
final class ObjectOutputTypeDocumentorTest extends TestCase
{
    public function testObject(): void
    {
        $perPage = new PerPage(12);
        $stub = EnumStub::Fiz;

        $composite = new class ($perPage, $stub, 1, true) {
            public function __construct(
                public PerPage $perPage,
                public ?EnumStub $stub,
                private int $foo,
                public bool $biz,
            ) {}
        };

        $documentor = new ObjectOutputTypeDocumentor();
        $document = $documentor->document($composite::class);

        self::assertInstanceOf(CompositeTypeDocument::class, $document);
        self::assertSame($composite::class, $document->getReference());
        self::assertNull($document->getDescription());
        self::assertNull($document->getDeprecated());

        self::assertSame(3, count($document->properties));

        $perPage = $document->properties['perPage'];
        self::assertSame(0, $perPage->range->minimal);
        self::assertSame(100, $perPage->range->maximal);
        self::assertSame(PerPage::class, $perPage->getReference());
        self::assertNull($perPage->getDescription());
        self::assertNull($perPage->getDeprecated());

        $stub = $document->properties['stub'];
        self::assertSame(EnumStub::cases(), $stub->cases);
        self::assertSame(EnumStub::class, $stub->getReference());
        self::assertNull($stub->getDescription());
        self::assertNull($stub->getDeprecated());

        $biz = $document->properties['biz'];
        self::assertInstanceOf(BoolTypeDocument::class, $biz);
    }
}
