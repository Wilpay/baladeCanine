<?php


namespace App\Controller;


use App\Entity\Profil;
use App\Entity\Utilisateur;
use App\Form\ProfilType;
use App\Form\UtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UtilisateurController extends Controller
{

    /**
     * @Route("/inscription", name="inscription")
     */
    public function Inscription(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder) {

        $user = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //Gérer le mot de passe : encodage
            $password = $encoder->encodePassword($user, $user->getPasswordPlain());
            $user->setPassword($password);


            $user->setRoles(['ROLE_USER']);
            $user->setVip(false);
            $user->setPrenium(false);
            $profil = new Profil();
            $profil->setUtilisateur($user);
            $em->persist($user);
            $em->persist($profil);
            $em->flush();
            $this->addFlash('success', 'Vous êtes inscrit');
            return $this->redirectToRoute('home');
        }
        return $this->render('User/inscription.html.twig', [
            'form' => $form->createView(),
            'utilisateur' => $user,
        ]);
    }


    /**
     * @Route("/connexion", name="connexion")
     */
    public function Connexion(Request $request, AuthenticationUtils $authenticationUtils, EntityManagerInterface $em) {

        $errors = $authenticationUtils->getLastAuthenticationError();
        $lastname = $authenticationUtils->getLastUsername();
        $form = $this->createForm(UtilisateurType::class);
        $form->handleRequest($request);

        $test = $request->request->get('_username');
        if($test != null OR empty($test))
        {
            $util = $em->getRepository(Utilisateur::class)->findOneByMail($test);
            if($util == null)
            {
                $this->addFlash('danger', 'Ce compte n\'existe pas');
                return $this->redirectToRoute('home');

            }
            else {
                $this->addFlash('succes', 'Vous êtes connecté(e)');
                return $this->redirectToRoute('home');
            }
        }



        return $this->render("Home/accueil.html.twig", [
            'lastusername' => $lastname,
            'form' => $form->createView(),
            'error' => $errors
        ]);

    }


    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(){}


    /**
     * @Route("/profil", name="profil")
     */
    public function Profil(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder) {

        $user = $this->getUser();
        $form = $this->createForm(UtilisateurType::class, $user);
        $util = $em->getRepository(Utilisateur::class)->find($user->getId());
        $profil = $em->getRepository(Profil::class)->findOneBySomeField($util->getId());
        $formPhoto = $this->createForm(ProfilType::class, $profil);
        $form->handleRequest($request);
        $formPhoto->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //Gérer le mot de passe : encodage
            $password = $encoder->encodePassword($user, $user->getPasswordPlain());
            $user->setPassword($password);



            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Profil modifié');
            return $this->redirectToRoute('profil');
        }
        else if($formPhoto->isSubmitted() && $formPhoto->isValid()) {
            if (null !== $formPhoto['file']->getData()) {
                $file = $formPhoto['file']->getData();
                // Efface le fichier et le nom déjà existant
                if (null !== $profil->getImage()) {
                    $oldFile = $this->getParameter('download_dir') . '/' . $profil->getImage();
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }
                $filename = $this->generateUniqueFileName() . '.' . $file->guessExtension();
                $profil->setImage($filename);
                $file->move(
                    $this->getParameter('download_dir'),
                    $filename
                );
                $em->persist($profil);
                $em->flush();
                $this->addFlash('success', 'Profil modifié');
                return $this->redirectToRoute('profil');
            }
        }
        return $this->render('User/profil.html.twig', [
            'form' => $form->createView(),
            'formPhoto' => $formPhoto->createView(),
            'utilisateur' => $user,
            'profil' => $profil,
        ]);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}