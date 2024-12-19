<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModuleController extends AbstractController
{
    #[Route('RP/module', name: 'module_show')]
    public function index(): Response
    {
        return $this->render('module/index.html.twig', [ 
        ]);
    }
}
