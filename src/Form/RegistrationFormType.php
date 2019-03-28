<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label'                        => 'Nom d\'utilisateur',
                'constraints'                  => [
                new NotBlank([
                    'message'                  => 'Veuillez renseigner un nom d\'utilisateur.',
                ]),
                new Length([
                    'min'                      => 4,
                    'minMessage'               => 'Votre nom d\'utilisateur doit faire au minimum {{ limit }} caractères.',
                    // max length allowed by Symfony for security reasons
                    'max'                      => 50,
                ]),
              ],
            ])
            ->add('email', RepeatedType::class, [
                  'type'                       => EmailType::class,
                  'invalid_message'            => 'Les emails ne correspondent pas.',
                  'options'                    => ['attr' => ['class' => 'email-field']],
                  'required'                   => true,
                  'first_options'              => ['label' => 'Email'],
                  'second_options'             => ['label' => 'Confirmation de l\'email'],
                  'constraints'                => [
                      new NotBlank([
                          'message'            => 'Veuillez renseigner un email',
                      ])
                  ],
            ])
            ->add('password', RepeatedType::class, [
                  'type' => PasswordType::class,
                  'invalid_message'            => 'Les mots de passe ne correspondent pas',
                  'options'                    => ['attr' => ['class' => 'password-field']],
                  'required'                   => true,
                  'first_options'              => ['label' => 'Mot de passe'],
                  'second_options'             => ['label' => 'Confirmation du mot de passe'],
                  'constraints'                => [
                      new NotBlank([
                          'message'            => 'Please enter a password',
                      ]),
                      new Length([
                          'min'                => 8,
                          'minMessage'         => 'Votre mot de passe doit faire au moins {{ limit }} caractères',
                          'max'                => 120,
                      ]),
                  ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
