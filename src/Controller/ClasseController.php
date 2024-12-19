<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    #[Route('RP/classe', name: 'classe_show')]
    public function index( EntityManagerInterface $em,
                           ClasseRepository $repo
                          ): Response
    {
        $classes=$repo->findAll();
        return $this->render('classe/index.html.twig', [
            "classes"=> $classes
        ]);
    }

    #[Route('RP/classe/{idClasse}', name: 'classe_edit')]
    public function edit($idClasse,ClasseRepository $repo){
        $classe=$repo->find($idClasse);
        $classes=$repo->findAll();
         return $this->render('classe/index.html.twig', [
            "classes"=> $classes,
            "classeSelected"=> $classe
        ]);
    }
    #[Route('RP/classe/{id}', name: 'classe_delete')]
    public function delete(Classe $classe, EntityManagerInterface $em ){
        $em->remove($classe);
        $em->flush();
        return $this->redirectToRoute('classe_show');
    }
}
