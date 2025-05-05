<?php

namespace App\Controller\Controller;

use App\Repository\ArtworkRepository;
use Doctrine\Common\Collections\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends AbstractController
{

    public function __construct(
        private ArtworkRepository $artworkRepository
    )
    {
    }

    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        $artworks = $this->artworkRepository->findBy(criteria: [], orderBy: ['createdAt' => Order::Descending->value]);

        return $this->render('app/index.html.twig', [
            'artworks' => $artworks
        ]);
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
