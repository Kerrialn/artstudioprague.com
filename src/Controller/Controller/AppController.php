<?php

namespace App\Controller\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{
    #[Route('/', name: 'homepage')]

    public function index(): Response
    {
        return $this->render('app/index.html.twig');
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('app/about.html.twig');
    }

    #[Route('/purchase', name: 'purchase')]
    public function purchase(): Response
    {
        return $this->render('app/purchase.html.twig');
    }

}
