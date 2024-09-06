<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\EmailType;



class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom_prenom', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^[a-zA-Z]+ [a-zA-Z]+$/',
                        'message' => 'Le nom et prénom doivent être deux mots séparés par un espace et composés de lettres uniquement.'
                    ])
                ]
            ])
            ->add('cin', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^\d{8,10}$/',
                        'message' => 'Le CIN doit être une chaîne de caractères composée de 8 à 10 chiffres.'
                    ])
                ]
            ])
            ->add('num_carte_fidalite', TextType::class)
            ->add('num_tel', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Regex([
                        'pattern' => '/^\d{10}$/',
                        'message' => 'Le numéro de téléphone doit être une chaîne de 10 chiffres.'
                    ])
                ]
            ])
            ->add('date_naissance', DateType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\LessThanOrEqual([
                        'value' => (new \DateTime())->modify('-18 years'),
                        'message' => 'L\'âge minimum doit être de 18 ans.'
                    ])
                ]
            ])
            ->add('email', TextType::class, [
                'constraints' => new Assert\Email()
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
