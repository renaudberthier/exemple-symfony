<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\DBAL\Exception\NotNullConstraintViolationException;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    // Afficher la liste de tous les utilisateurs
    #[Route('/liste-utilisateurs', name: 'user_index')]
    public function index(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('user/index.html.twig', [
            'users' => $users
        ]);
    }

    // Voir un utilisateur en particulier
    #[Route('/voir-utilisateur/{id}', name: 'user_show')]
    public function show_user(string $id, UserRepository $userRepository): Response
    {
        $id = intval($id); // Transformer $id en valeur numérique
        $user = $userRepository->find($id); // Cherche l'user avec l'id $id

        if(!$user) { // Si on ne l'a pas trouvé
            throw new NotFoundHttpException(); // Erreur 404
        }
        
        return $this->render('user/show.html.twig', [
            'user' => $user
        ]);
    }

    // Supprimer un utilisateur en particulier
    #[Route('/supprimer-utilisateur/{id}', name: 'user_delete')]
    public function delete_user(string $id, UserRepository $userRepository): Response
    {
        $id = intval($id); // Transformer $id en valeur numérique
        $user = $userRepository->find($id); // Cherche l'user avec l'id $id

        if(!$user) { // Si on ne l'a pas trouvé
            throw new NotFoundHttpException(); // Erreur 404
        }
        
        $userRepository->remove($user); // On supprime l'user
        return $this->redirectToRoute('user_index'); // On redirige à l'accueil
    }

    // Créer un nouvel utilisateur
    #[Route('/creer-utilisateur', name: 'user_create', methods: 'GET|HEAD')]
    public function create(): Response
    {
        // Traitement supplémentaire possible
        // Exemple : Vérifier si la personne a le droit d'accéder à la page

        // Affichage du formulaire
        return $this->render('user/create.html.twig');
    }

    // Créer un nouvel utilisateur
    #[Route('/creer-utilisateur', name: 'user_persist', methods: 'POST')]
    public function persist(Request $request, UserRepository $userRepository): Response
    {
        // Traitement de l'information saisie
        $firstname = $request->request->get('firstname');
        $lastname = $request->request->get('lastname');
        $age = $request->request->getInt('age');

        $user = new User();
        $user->setFirstname($firstname);
        $user->setLastname($lastname);
        $user->setAge($age);

        // Autre manière de faire :
        // $user->setFirstname($firstname)
        //      ->setLastname($lastname)
        //      ->setAge($age);

        $userRepository->add($user);
        return $this->redirectToRoute('user_index');
    }
}
