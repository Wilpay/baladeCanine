<?php


namespace App\Form;

use App\Entity\Animal;
use App\Entity\CategorieAnimal;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Categorie', EntityType::class, array(
                'class' => CategorieAnimal::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.libelle', 'ASC');
                },
                'choice_label' => 'libelle'
            ))
            ->add('nom', null, [
                "label_format" => "Nom"
            ])
            ->add('dateNaissance', DateType::class, [
                "label_format" => "Heure de début",
                'widget' => 'single_text'
            ])

            ->add('poids', NumberType::class, [
                "label_format" => "Poids"
            ])
            ->add('submit', SubmitType::class, array(
                'label' => 'Valider'))
            //->add('etat', null, ["label_format" => "Etat de la sortie"])
            //->add('lieu', EntityType::class, array(
            //    "label_format" => "Lieu",
            //    'class' => Lieu::class,
            //Attribut utilisé pour l'affichage
            //    'choice_label' => 'nom'
            //))
            //->add('ville', EntityType::class, array(
            //    "label_format" => "ville",
            //    'class' => Ville::class,
            //Attribut utilisé pour l'affichage
            //    'choice_label' => 'nom',
            //Fait une requête particulière
            //    'query_builder' => function (EntityRepository $er) {
            //        return $er->createQueryBuilder('c')
            //            ->orderBy('c.nom', 'ASC');
            //    }
            //))
            //->add('organisateur', EntityType::class, ["label_format" => "Etat",'class' => Ville::class,'choice_label' => 'libelle'])
            //->add('etat', EntityType::class, ["label_format" => "Etat",'class' => Etat::class,'choice_label' => 'libelle'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}