<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultResponsesWithAbstractController extends AbstractController
{

    /**
     * A basic default response for invalid request bodys.
     *
     * @return Response The default response
     */
    protected function invalidRequestResponse(): Response
    {
        return $this->json([
            'message' => 'Your json request had the wrong shape',
            'code' => 400
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * A basic default response for an unauthorized user
     *
     * @return Response The default response
     */
    protected function notAuthorizedResponse(): Response
    {
        return $this->redirect('/login');
    }

    /**
     * Creates a default response for elements that are not existing on the server
     *
     * @param string $message The name of the element
     * @return Response The default response
     */
    protected function exceptionResponse(string $message): Response
    {
        return $this->json([
            'message' => $message
        ], Response::HTTP_BAD_REQUEST);
    }
}