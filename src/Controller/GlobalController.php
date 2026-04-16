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

    #[Route('/contact', methods: ['GET'], name: 'contact')]
    public function contact(): Response
    {
        return new Response('formulaire de contact');
    }

    #[Route('/contact', methods: ['POST'], name: 'contact_submit')]
    public function contactSubmit(): Response
    {
        return new Response('formulaire de contact soumis');
    }

    #[Route('/about' , name: 'about')]
    public function about(): Response
    {
        return $this->render('global/about.html.twig', [
            'controller_name' => 'GlobalController',
        ]);
    }

    #[Route('/article/nouveau' , name: 'article_nouveau')]
    public function articleNouveau(): Response
    {
        return new Response('nouvel article créé');
    }

    #[Route('/article/{slug}' , name: 'article')]
    public function article(string $slug): Response
    {
        return $this->render('global/article.html.twig', [
            'slug' => $slug,
        ]);
    }
}
