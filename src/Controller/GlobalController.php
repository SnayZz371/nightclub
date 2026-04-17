<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Map\Bridge\Leaflet\LeafletOptions;
use Symfony\UX\Map\Bridge\Leaflet\Option\TileLayer;
use Symfony\UX\Map\InfoWindow;
use Symfony\UX\Map\Map;
use Symfony\UX\Map\Marker;
use Symfony\UX\Map\Point;




final class GlobalController extends AbstractController
{
    #[Route('/', name: 'global')]
    public function index(): Response
    {
        return $this->render('global/index.html.twig', [
            'test' => 'test',
        ]);
    }

    #[Route('/contact', name: 'contact')]
    public function contact(Request $request): Response
    {

        $form = $this->createForm(ContactType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dd($data);
        }

        $map = (new Map('default'))
            ->center(new Point(45.7534031, 4.8295061))
            ->zoom(6)

            ->addMarker(new Marker(
                position: new Point(45.7534031, 4.8295061),
                title: 'Lyon',
                infoWindow: new InfoWindow(
                    content: '<p>Thank you <a href="https://github.com/Kocal">@Kocal</a> for this component!</p>',
                )
            ))

            ->options((new LeafletOptions())
                ->tileLayer(new TileLayer(
                    url: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
                    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                    options: ['maxZoom' => 19]
                ))
            );
        return $this->render('global/contact.html.twig', [
            'map' => $map,
            'form' => $form,
        ]);
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
        dump($historique);
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