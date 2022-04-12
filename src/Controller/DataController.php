<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DataController extends AbstractController
{
    #[Route('/test-formulaire', name: 'test_formulaire')]
    public function index(Request $request): Response
    {
        // Données en POST : $request->request
        $firstname = $request->request->get('firstname');
        // Des données en GET : $request->query
        // $firstname = $request->query->get('firstname');
        return $this->render('data/index.html.twig', [
            "firstname" => $firstname
        ]);
    }
}
