<?php

namespace App\Controller;

use App\Entity\User;
use App\Utils\TokenGenerator;
use Doctrine\ORM\EntityManagerInterface;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

/**
 * Handles all the user authorization.
 */
class SecurityController extends DefaultResponsesWithAbstractController
{
    private Security $security;
    private TokenGenerator $tokenGenerator;
    private EntityManagerInterface $entityManager;

    public function __construct(
        Security $security,
        TokenGenerator $tokenGenerator,
        EntityManagerInterface $entityManager
    ) {
        $this->security = $security;
        $this->tokenGenerator = $tokenGenerator;
        $this->entityManager = $entityManager;
    }

    /**
     * Handles the process of logging in the user into the system.
     */
    #[Route('/api/login', name: 'api_login', methods: [Request::METHOD_POST])]
    public function apiLogin(): Response
    {
        $user = $this->security->getUser();

        if (null === $user) {
            return $this->json([
                'message' => 'invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }
        try {
            $token = $this->tokenGenerator->generateSecureLoginToken();
            if ($user instanceof User) {
                $user->setToken($token);
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                return $this->json([
                    'user' => $this->security->getUser()->getUserIdentifier(),
                    'token' => $token,
                    'roles' => $this->security->getUser()->getRoles(),
                ], Response::HTTP_OK);
            }
            return $this->json([
                'message' => 'login failed'
            ], Response::HTTP_UNAUTHORIZED);
        } catch (Exception $e) {
            return $this->json([
                'message' => 'something went wrong while initializing auth token',
                'debugMessage' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Checks whether the user is logged in correctly into the system or not.
     */
    #[Route('/api/check_login', name: 'api_login_check', methods: [Request::METHOD_GET])]
    public function checkLogin(): Response
    {
        $user = $this->security->getUser();
        if ($user instanceof User) {
            return $this->json([
                'userIdentifier' => $user->getUserIdentifier(),
                'roles' => $user->getRoles()
            ], Response::HTTP_OK);
        }

        return $this->json([
            'message' => 'The user is unauthorized',
        ], Response::HTTP_UNAUTHORIZED);
    }

}