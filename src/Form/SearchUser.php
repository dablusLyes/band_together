<?php


namespace App\Form;


use App\Entity\Departements;
use App\Entity\Instruments;
use App\Entity\Search;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SearchUser extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('departements', EntityType::class, [
                'class' => Departements::class,
                'choice_label' => 'nom',
                'placeholder' => 'Tous les départements',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('instruments',  EntityType::class, [
                // looks for choices from this entity
                'class' => Instruments::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'nom',
                // used to render a select box, check boxes or radios
                'placeholder'=>'Tous les instruments',
                'multiple' => false,
                'expanded' => false,
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
        ]);
    }
}