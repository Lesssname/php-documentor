<?php
declare(strict_types=1);

namespace LessDocumentor\Type;

use LessDocumentor\Type\Exception\UnexpectedInput;
use LessDocumentor\Type\Document\TypeDocument;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

final class ClassParametersTypeDocumentor extends AbstractClassTypeDocumentor
{
    private readonly TypeDocumentor $methodInputTypeDocumentor;

    public function __construct(?TypeDocumentor $methodInputTypeDocumentor = null)
    {
        $this->methodInputTypeDocumentor = $methodInputTypeDocumentor ?? new MethodInputTypeDocumentor(new HintTypeDocumentor($this));
    }

    /**
     * @param class-string $class
     *
     * @throws UnexpectedInput
     * @throws ReflectionException
     */
    protected function documentObject(string $class): TypeDocument
    {
        $classReflected = new ReflectionClass($class);
        $constructor = $classReflected->getConstructor();
        assert($constructor instanceof ReflectionMethod);

        return $this
            ->methodInputTypeDocumentor
            ->document($constructor)
            ->withReference($class);
    }
}
