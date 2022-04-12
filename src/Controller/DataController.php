<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DataController extends AbstractController
{
    #[Route('/test-formulaire', name: 'test_form')]
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

    #[Route('/correction-formulaire', name: 'exercise_form')]
    public function exercise(Request $request) : Response
    {
        // Récupérer toutes les valeurs :
        // $all = $request->request->all();
        // var_dump($all);

        // Récupérer toutes les clefs :
        // $keys = $request->request->keys();
        // var_dump($keys);

        // Une valeur par défaut :
        // $age = $request->request->getInt('age', 45);

        $firstname = $request->request->get('firstname');
        $lastname = $request->request->get('lastname');
        $age = $request->request->getInt('age');

        $test = "Toto";
        $estcequelavaleurestvide = !$test; // false -> 0
        $estcequelavaleurestpleine = !!$test; // true -> 1
        $a = !!!$test; // = !$test
        
        // Etape 1 : Transformer $test en booléen
        $test = (bool) $test; // true

        $error = null;
        if(
            // Si y'a firstname
            // Ca vaut true (1)
            // Sinon false  (0)
            !!$firstname + !!$lastname + !!$age > 0 && 
            !!$firstname + !!$lastname + !!$age < 3
        ) {
            $error = "Il manque des champs";
        }

        return $this->render('data/exercise.html.twig', [
            "firstname" => $firstname,
            "lastname" => $lastname,
            "age" => $age,
            "error" => $error
        ]);
    }

    #[Route('/test-donnees-complexes', name: 'test_complex')]
    public function complex(): Response
    {
        $products = [
            [
                "name" => "Une pomme",
                "price" => 12.25,
                "tags" => ["Fruit", "En promotion"],
                "reseller" => [
                    "siren" => "123456789",
                    "address" => [
                        "line1" => "1 rue Test",
                        "line2" => "75020 PARIS",
                    ]
                ]
            ],
            [
                "name" => "Une poire",
                "price" => 10.25,
                "tags" => ["Fruit", "En promotion"],
                "reseller" => [
                    "siren" => "987654321",
                    "address" => [
                        "line1" => "12 rue Test",
                        "line2" => "75011 PARIS",
                    ]
                ]
            ],
            [
                "name" => "Une fraise",
                "price" => 5.25,
                "tags" => ["Fruit", "En promotion"],
                "reseller" => [
                    "siren" => "123456789",
                    "address" => [
                        "line1" => "71 rue Test",
                        "line2" => "75015 PARIS",
                    ]
                ]
            ]
        ];
        
        return $this->render('data/complex.html.twig', [
            "products" => $products
        ]);
    }
}
