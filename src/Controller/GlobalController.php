<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GlobalController extends AbstractController
{
    #[Route('/', name: 'global')]
    public function index(): Response
    {
        return $this->render('global/index.html.twig', [
            'controller_name' => 'GlobalController',
        ]);
    }

    #[Route('/contact' , name: 'contact')]
    public function contact(): Response
    {
        return $this->render('global/contact.html.twig', [
            'controller_name' => 'GlobalController',
        ]);
    }

    #[Route('/about' , name: 'about')]
    public function about(): Response
    {
        return $this->render('global/about.html.twig', [
            'controller_name' => 'GlobalController',
        ]);
    }
}

