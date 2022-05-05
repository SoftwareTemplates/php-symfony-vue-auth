<?php

namespace App\Controller;

use App\Exception\NotAuthorizedException;
use App\Exception\UserNotFoundException;
use App\Service\UserService;
use App\Validator\UserRequestValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

/**
 * REST Controller for all user actions
 */
class UserController extends DefaultResponsesWithAbstractController
{
    private UserRequestValidator $validator;
    private UserService $userService;

    public function __construct(
        UserRequestValidator $userRequestValidator,
        UserService $userService,
    ) {
        $this->validator = $userRequestValidator;
        $this->userService = $userService;
    }

    /**
     * Creates a new user in the inventory system.
     */
    #[Route('/api/user/createUser', methods: Request::METHOD_POST)]
    public function createUser(Request $request): Response
    {
        if (!$this->validator->validateCreateUserRequest($request)) {
            return $this->invalidRequestResponse();
        }
        $requestContent = json_decode($request->getContent(), true);

        try {
            $user = $this->userService->createNewUser(
                $requestContent['username'],
                $requestContent['password'],
                $requestContent['permissionGroups'],
                $requestContent['roles']
                );

            return $this->json([
               'message' => 'User created successfully',
               'user' => $user
            ]);
        } catch (NotAuthorizedException $e) {
            return $this->notAuthorizedResponse();
        }
    }

    /**
     * Deletes a user from the inventory system.
     */
    #[Route('/api/user/deleteUser', methods: Request::METHOD_POST)]
    public function deleteUser(Request $request): Response {

        if (!$this->validator->validateDeleteUserRequest($request)) {
            return $this->invalidRequestResponse();
        }
        $requestContent = json_decode($request->getContent(), true);
        try {
            $this->userService->deleteUser($requestContent['userID']);
            return $this->json([
                'message' => 'Successfully removed user from system',
                'success' => true,
            ]);
        } catch (NotAuthorizedException $e) {
            return $this->notAuthorizedResponse();
        } catch (UserNotFoundException $e) {
            return $this->exceptionResponse($e->getMessage());
        }
    }

    /**
     * Gets all users in the system
     */
    #[Route('/api/user/allUsers', methods: Request::METHOD_GET)]
    public function allUsers(): Response {
        try {
            return $this->json([
                'users' => array_map(function($user) {
                    return $user;
                }, $this->userService->getAllUsers())
            ]);
        } catch (NotAuthorizedException $e) {
            return $this->notAuthorizedResponse();
        }
    }

    /**
     * Updates an user.
     */
    #[Route('/api/user/updateUser', methods: Request::METHOD_POST)]
    public function updateUser(Request $request): Response
    {
        if (!$this->validator->validateUpdateUserRequest($request)) {
            return $this->invalidRequestResponse();
        }
        $requestContent = json_decode($request->getContent(), true);
        try {
            return $this->json([
                'message' => 'Successfully updated user',
                'user' => $this->userService->updateUser(
                    $requestContent['id'],
                    $requestContent['username'],
                    $requestContent['roles']
                )
                ]);
        } catch (NotAuthorizedException $e) {
            return $this->notAuthorizedResponse();
        } catch (UserNotFoundException $e) {
            return $this->exceptionResponse($e->getMessage());
        }
    }
}