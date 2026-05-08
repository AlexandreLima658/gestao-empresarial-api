<?php

namespace App\Application\UseCases;

/**
 * @template TInput
 * @template TOutput
 */
abstract class UseCase
{
    /**
     * @param TInput $input
     * @return TOutput
     */
    abstract protected function execute($input);

}

