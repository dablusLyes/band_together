<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', RepeatedType::class, [
                  'type' => EmailType::class,
                  'invalid_message' => 'Les deux champs mail doivent être identique.',
                  'options' => ['attr' => ['class' => 'password-field']],
                  'required' => true,
                  'first_options'  => ['label' => 'Entrez votre Email'],
                  'second_options' => ['label' => 'Confirmez votre Email'],
<<<<<<< HEAD
                  'constraints' => [
                      new NotBlank([
                          'message' => 'Please enter a password',
                      ]),
                      new Length([
                          'min' => 6,
                          'minMessage' => 'Your password should be at least {{ limit }} characters',
                          // max length allowed by Symfony for security reasons
                          'max' => 50,
                      ]),
                  ],
=======
>>>>>>> 492545bb016927b8c7dd96222d8826e36a2dc563
            ])
            ->add('password', RepeatedType::class, [
                  'type' => PasswordType::class,
                  'invalid_message' => 'Les deux champs mot de passe doivent être identique.',
                  'options' => ['attr' => ['class' => 'password-field']],
                  'required' => true,
                  'first_options'  => ['label' => 'Mot de passse'],
                  'second_options' => ['label' => 'Confirmez votre mot de passe'],
<<<<<<< HEAD
                  'constraints' => [
                      new NotBlank([
                          'message' => 'Please enter a password',
                      ]),
                      new Length([
                          'min' => 6,
                          'minMessage' => 'Your password should be at least {{ limit }} characters',
                          // max length allowed by Symfony for security reasons
                          'max' => 120,
                      ]),
                  ],
=======
>>>>>>> 492545bb016927b8c7dd96222d8826e36a2dc563
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
