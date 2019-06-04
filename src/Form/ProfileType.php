<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Instruments;
use App\Entity\Departements;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('email')
            ->add('username')
            ->add('instruments',  EntityType::class, [
                  // looks for choices from this entity
                  'class' => Instruments::class,
                  // uses the User.username property as the visible option string
                  'choice_label' => 'nom',
                  // used to render a select box, check boxes or radios
                  'multiple' => true,
                  'expanded' => true,
              ])
              ->add('departements', EntityType::class, [
                'class' => Departements::class,
                'choice_label' => 'departement',
              ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'validation_groups' => ['Profil'],
        ]);
    }
}
