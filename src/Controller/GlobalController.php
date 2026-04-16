<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


final class GlobalController extends AbstractController
{
    #[Route('/', name: 'global')]
    public function index(): Response
    {
        return $this->render('global/index.html.twig', [
            'test' => 'test',
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
        $historique = [
            '2020' => 'Création de l\'entreprise',
            '2021' => 'Lancement du premier produit',
            '2022' => 'Expansion à l\'international',
            '2023' => 'Lancement de la version 2.0',
            '2024' => 'Mise en production',
            '2025' => 'Atteinte de 1 million d\'utilisateurs',
            '2026' => 'Sortie sur le marché',
        ];
        return $this->render('global/about.html.twig', [
            'historique' => $historique,
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

    #[Route('/bonjour' , name: 'bonjour')]
    public function bonjour(Request $request): Response
    {
        if (!$prenom = $request->query->get('prenom')) {
            return new Response('Bonjour invité');
        }
        return new Response('Bonjour ' . $prenom);

    }

    #[Route("/json/etape", name: "json_etape")]
    public function jsonEtape(): Response
    {
        $etapes = [
    [
            'id' => 1,
            'annee' => '2026',
            'texte' => 'Description de l\'étape 1',
        ],
        [
            'id' => 2,
            'annee' => '2027',
            'texte' => 'Description de l\'étape 2',
        ]
        ];
        return $this->json($etapes, Response::HTTP_OK);
    }
}