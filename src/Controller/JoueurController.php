<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Joueur;
use App\Repository\JoueurRepository;
use Doctrine\Persistence\ManagerRegistry;

class JoueurController extends AbstractController
{
    #[Route('/joueurs', name: 'app_joueur')]
    public function list(JoueurRepository $repo): Response
    {
        $joueurs = $repo->findAll();;

        return $this->render('joueur/list.html.twig', ['joueurs' => $joueurs]);
    }
    #[Route('/deletejoueur', name: 'delete_joueur')]
    public function deleteGardiens(JoueurRepository $repo,ManagerRegistry $doctrine): Response
    {
        $gardiens = $repo->findBy(['role' => 'gardien']);
        $entityManager = $doctrine->getManager();
        foreach ($gardiens as $gardien) {
            $entityManager->remove($gardien);
        }

        $entityManager->flush();


        return $this->redirectToRoute('app_joueur');
    }
}
