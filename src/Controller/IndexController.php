<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Handles all index pages.
 */
class IndexController extends AbstractController
{
    /**
     * The default page controller
     */
    #[Route('/{vuePath}', requirements: ['vuePath' => '^(?!api).+'], methods: [Request::METHOD_GET])]
    public function vueRouting(?string $vuePath): Response
    {
       return $this->render('base.html.twig');
    }

    #[Route('/', methods: [Request::METHOD_GET])]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }
}