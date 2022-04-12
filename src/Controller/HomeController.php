<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        $adresseLigne1 = "1, rue Truc";
        $adresseLigne2 = "75015 Paris";
        return $this->render('home/contact.html.twig', [
            "adresseLigne1" => $adresseLigne1,
            "adresseLigne2" => $adresseLigne2
        ]);
    }

    #[Route('/plandusite', name: 'app_sitemap')]
    public function sitemap(): Response
    {
        $links = [
            'app_home'      => "Accueil",
            'app_contact'   => "Contact",
            'app_sitemap'   => "Plan du site"
        ];
        return $this->render('home/sitemap.html.twig', [
            "links" => $links
        ]);
    }
}
