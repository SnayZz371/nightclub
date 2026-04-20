<?php

namespace App\Controller;

use App\Entity\Soiree;
use App\Form\SoireeType;
use App\Repository\SoireeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SoireeController extends AbstractController
{
    #[Route('/soiree', name: 'app_soiree')]
    public function index(): Response
    {
        return $this->render('soiree/index.html.twig', [
            'controller_name' => 'SoireeController',
        ]);
    }
    #[Route('/soiree/creer', name: 'creer_soiree')]
    function creer_soiree(EntityManagerInterface $em, Request $request): Response
    {
        $soiree = new Soiree();
        $form = $this->createForm(SoireeType::class, $soiree,[
            'attr' => ['novalidate' => 'novalidate']
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($soiree);
            $em->flush();
            return $this->redirectToRoute('soirees');
        }
        return $this->render('soiree/creer.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/soirees', name: 'soirees')]
function soirees(SoireeRepository $soireeRepository) {
       $soirees = $soireeRepository->findAll();
       dd($soirees);
   }
   #[Route('/soiree/{id}/read', name: 'soiree')]
function soiree(SoireeRepository $soireeRepository, int $id) {
       $soiree = $soireeRepository->find($id);
       dd($soiree);
   }
   #[Route('/soiree/{id}/update', name: 'update_soiree')]
   function update_soiree(EntityManagerInterface $em, int $id) {
    $repository = $em->getRepository(Soiree::class);
    $soiree = $repository->find($id);
       $soiree->setTitre("Soirée !");
         $em->flush();
         dd($soiree);
   }
   #[Route('/soiree/{id}/delete', name: 'delete_soiree')]
   function delete_soiree(EntityManagerInterface $em, int $id)
   {
       $repository = $em->getRepository(Soiree::class);
       $soiree = $repository->find($id);
       $em->remove($soiree);
       $em->flush();
       return $this->redirectToRoute('soirees');
   }
}