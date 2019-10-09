<?php


namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurController extends Controller
{

    /**
     * @Route("/inscription", name="inscription")
     */
    public function Inscription(EntityManagerInterface $em, SessionInterface $session) {

        return $this->render("Utilisateur/inscription.html.twig");
    }

}