<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin', name: 'app_admin')]
final class AdminController extends AbstractController
{
    #[Route('/dashboard', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig' );
    }
}