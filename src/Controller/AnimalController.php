<?php


namespace App\Controller;


use App\Entity\Animal;
use App\Form\AnimalType;
use App\Form\ProfilAnimalType;
use App\Form\ProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AnimalController extends Controller
{
    /**
     * @Route("/animal", name="animal")
     */
    public function Animal(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder) {

        $animal = new Animal();
        $user = $this->getUser();
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //Gérer le mot de passe : encodage

            $animal->setMaitre($user);




            $em->persist($animal);
            $em->flush();
            $this->addFlash('success', 'Animal ajouté');
            return $this->redirectToRoute('home');
        }

        return $this->render('Animal/nouveau.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/mesanimaux", name="mesanimaux")
     */
    public function MesAnimaux(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder) {

        $animaux = $em->getRepository(Animal::class)->findByMaitre($this->getUser()->getId());

        return $this->render('Animal/animaux.html.twig', [
            'animaux' => $animaux,
        ]);
    }

    /**
     * @Route("/modifier/{id}", name="modifier")
     */
    public function Modifier(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder, $id) {

        $animal = $em->getRepository(Animal::class)->find($id);
        $form = $this->createForm(AnimalType::class, $animal);
        $formPhoto = $this->createForm(ProfilAnimalType::class, $animal);
        $form->handleRequest($request);
        $formPhoto->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($animal);
            $em->flush();
            $this->addFlash('success', 'Animal modifier');
            return $this->redirectToRoute('mesanimaux');
        }

        return $this->render('Animal/modifier.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}