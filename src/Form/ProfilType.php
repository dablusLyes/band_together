<?php

namespace App\Form;

use App\Entity\Groupe;
use App\Entity\Style;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           // ->add('email')


            ->add('name')
            ->add('surname')
            ->add('description')
            ->add('url_music')
            ->add('url_video')
             //->add('style')
            ->add('style', EntityType::class, [
                // looks for choices from this entity
                'class' => Style::class,

                // uses the User.username property as the visible option string
                'choice_label' => 'nom',

                // used to render a select box, check boxes or radios
                 'multiple' => true,
                 'expanded' => true,
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
