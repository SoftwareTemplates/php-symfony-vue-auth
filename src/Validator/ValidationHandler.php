<?php

namespace App\Validator;

use Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Can be used for further validation
 */
class ValidationHandler
{

    private ValidatorInterface $validator;

    public function __construct()
    {
        $this->validator = Validation::createValidator();
    }

    /**
     * @param Request $request The general request to the server that should be validated
     * @param Collection $constraints The constraints that are defined for request validation
     * @return bool If the request is valid or not
     */
    protected function validateRequest(Request $request, Collection $constraints): bool
    {
        return count($this->validator->validate(json_decode($request->getContent(), true), $constraints)) === 0;
    }
}