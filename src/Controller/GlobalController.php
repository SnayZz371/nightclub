<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    #[Route('/', name: 'accueil')]
    public function index(): Response
    {
        return $this->render('global/index.html.twig', [
            'title' => 'Nightclub',
        ]);
    }

    #[Route("/contact", name: "contact")]
    public function contact(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dd($data); 
        }

        $map = (new Map('default'))
            ->center(new Point(47.3881023, 0.8269289))
            ->zoom(6)

            ->addMarker(new Marker(
                position: new Point(47.3881023, 0.8269289),
                title: 'Montlouis',
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

        return $this->render("global/contact.html.twig", ['map' => $map, 'monForm' => $form]);
    }

    #[Route("/apropos", name: "apropos")]
    public function apropos(): Response
    {
        $historique = [
            ["année" => 2020, "texte" => "Construction de la discothèque"],
            ["année" => 2021, "texte" => "Ouverture de la discothèque"],
            ["année" => 2022, "texte" => "Nouvelle extension"],
        ];

        return $this->render("global/apropos.html.twig", ['historiques' => $historique]);
    }

    #[Route("/article/nouveau", name: "article_nouveau")]
    public function articleNouveau(): Response
    {
        return new Response("Nouvel article créé !");
    }

    #[Route("/article/{slug}", name: "article")]
    public function article(string $slug): Response
    {
        return $this->render("global/article.html.twig", ['slug' => $slug]);
    }

    #[Route("/bonjour", name: "bonjour", methods: ["GET"])]
    public function bonjour(Request $request): Response
    {
        if ($request->query->get('prenom')) {
            return new Response("Bonjour {$request->query->get('prenom')} ");
        } else {
            return new Response("Bonjour invité");
        }
    }

    #[Route("/json/etapes", name: "json_etapes")]
    public function json_etapes(): JsonResponse
    {
        $etapes = [["id" => 1, "année" => 2020, "texte" => "Étape 1"], ["id" => 2, "année" => 2021, "texte" => "Étape 2"], ["id" => 3, "année" => 2022, "texte" => "Étape 3"]];
        return $this->json($etapes);
    }
}
