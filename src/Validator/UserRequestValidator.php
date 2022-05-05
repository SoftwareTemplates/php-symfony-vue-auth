<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Required;

class UserRequestValidator extends ValidationHandler
{

    /**
     * Validates the request for the createUser endpoint.
     */
    public function validateCreateUserRequest(Request $request): bool
    {
        $constraints = new Collection([
            'username' => new Type('string'),
            'password' => new Type('string'),
            'roles' => new Type('array')
        ]);
        return $this->validateRequest($request, $constraints);
    }

    /**
     * Validates the request for deleteUser endpoint.
     */
    public function validateDeleteUserRequest(Request $request): bool
    {
        $constraints = new Collection([
            'userID' => new Type('integer')
        ]);
        return $this->validateRequest($request, $constraints);
    }

    /**
     * Validates the request to updateUser endpoint.
     */
    public function validateUpdateUserRequest(Request $request): bool
    {
        $constraints = new Collection([
            'id' => new Type('integer'),
            'username' => new Type('string'),
            'roles' => new Type('array')
        ]);
        return $this->validateRequest($request, $constraints);
    }
}