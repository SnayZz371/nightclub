<?php

namespace App\Controller;

use App\Entity\Soiree;
use App\Form\Soiree1Type;
use App\Repository\SoireeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/soiree')]
final class SoireeController extends AbstractController
{
    #[Route(name: 'app_soiree_index', methods: ['GET'])]
    public function index(SoireeRepository $soireeRepository): Response
    {
        return $this->render('soiree/index.html.twig', [
            'soirees' => $soireeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_soiree_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $soiree = new Soiree();
        $form = $this->createForm(SoireeType::class, $soiree,[
            'attr' => ['novalidate' => 'novalidate']
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_soiree_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('soiree/edit.html.twig', [
            'soiree' => $soiree,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_soiree_delete', methods: ['POST'])]
    public function delete(Request $request, Soiree $soiree, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$soiree->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($soiree);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_soiree_index', [], Response::HTTP_SEE_OTHER);
    }
}
