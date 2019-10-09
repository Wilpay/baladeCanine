<?php


namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(EntityManagerInterface $em, SessionInterface $session) {

        return $this->render("Home/accueil.html.twig");
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function Inscription(EntityManagerInterface $em, SessionInterface $session) {

        return $this->render("Home/accueil.html.twig");
    }

}