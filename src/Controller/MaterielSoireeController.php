<?php

namespace App\Controller;

use App\Entity\MaterielSoiree;
use App\Form\MaterielSoireeType;
use App\Repository\MaterielSoireeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/materiel/soiree')]
final class MaterielSoireeController extends AbstractController
{
    #[Route(name: 'app_materiel_soiree_index', methods: ['GET'])]
    public function index(MaterielSoireeRepository $materielSoireeRepository): Response
    {
        return $this->render('materiel_soiree/index.html.twig', [
            'materiel_soirees' => $materielSoireeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_materiel_soiree_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $materielSoiree = new MaterielSoiree();
        $form = $this->createForm(MaterielSoireeType::class, $materielSoiree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($materielSoiree);
            $entityManager->flush();

            return $this->redirectToRoute('app_materiel_soiree_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('materiel_soiree/new.html.twig', [
            'materiel_soiree' => $materielSoiree,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_materiel_soiree_show', methods: ['GET'])]
    public function show(MaterielSoiree $materielSoiree): Response
    {
        return $this->render('materiel_soiree/show.html.twig', [
            'materiel_soiree' => $materielSoiree,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_materiel_soiree_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MaterielSoiree $materielSoiree, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MaterielSoireeType::class, $materielSoiree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_materiel_soiree_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('materiel_soiree/edit.html.twig', [
            'materiel_soiree' => $materielSoiree,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_materiel_soiree_delete', methods: ['POST'])]
    public function delete(Request $request, MaterielSoiree $materielSoiree, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$materielSoiree->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($materielSoiree);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_materiel_soiree_index', [], Response::HTTP_SEE_OTHER);
    }
}
