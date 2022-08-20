<?php
declare(strict_types=1);

namespace LessDocumentor\Type;

use LessDocumentor\Type\Document\BoolTypeDocument;
use LessDocumentor\Type\Document\Composite\Property;
use LessDocumentor\Type\Document\CompositeTypeDocument;
use LessDocumentor\Type\Document\TypeDocument;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;
use RuntimeException;

final class MethodInputTypeDocumentor
{
    public function document(ReflectionMethod $method): TypeDocument
    {
        $parameters = [];

        foreach ($method->getParameters() as $parameter) {
            $type = $parameter->getType();

            assert($type instanceof ReflectionNamedType, new RuntimeException());

            $parameters[$parameter->getName()] = new Property(
                $this->getParameterType($parameter),
                $type->allowsNull() === false && $parameter->isDefaultValueAvailable() === false,
                $parameter->isDefaultValueAvailable()
                    ? $parameter->getDefaultValue()
                    : null,
            );
        }

        return new CompositeTypeDocument($parameters);
    }

    private function getParameterType(ReflectionParameter $parameter): TypeDocument
    {
        $type = $parameter->getType();

        assert($type instanceof ReflectionNamedType, new RuntimeException());

        $typename = $type->getName();

        if (!class_exists($typename)) {
            return match ($typename) {
                'bool' => $type->allowsNull()
                    ? (new BoolTypeDocument())->withNullable()
                    : new BoolTypeDocument(),
                'array' => $type->allowsNull()
                    ? (new CompositeTypeDocument([], true))->withNullable()
                    : new CompositeTypeDocument([], true),
                default => throw new RuntimeException($typename),
            };
        }

        $paramDocument = (new ObjectInputTypeDocumentor())->document($typename);

        return $type->allowsNull()
            ? $paramDocument->withNullable()
            : $paramDocument;
    }
}
