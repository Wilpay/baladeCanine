<?php


namespace App\Form;

use App\Entity\Animal;
use App\Entity\Caractere;
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
            ->add('caracteres', EntityType::class, array(
                'class' => Caractere::class,
                'multiple' => true,
                'choice_label' => 'libelle',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('s')
                        ->orderBy('s.libelle', 'ASC');
                },

            ))

            ->add('submit', SubmitType::class, array(
                'label' => 'Valider'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}