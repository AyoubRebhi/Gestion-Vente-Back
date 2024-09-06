<?php

namespace App\Form;

use App\Entity\Vente;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VenteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idClient')
            ->add('listeArticles')
            ->add('remiseGlobale')
            ->add('netApayer')
            ->add('payer')
            ->add('aRendre')
            ->add('totalTTC')
            ->add('dateAchat', null, [
                'widget' => 'single_text',
            ])
            ->add('BV')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vente::class,
        ]);
    }
}
