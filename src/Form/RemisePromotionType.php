<?php

namespace App\Form;

use App\Entity\RemisePromotion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RemisePromotionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('remise_article')
            ->add('remise_client')
            ->add('est_inclure_description')
            ->add('article_offert')
            ->add('date_debut', null, [
                'widget' => 'single_text',
            ])
            ->add('date_fin', null, [
                'widget' => 'single_text',
            ])
            ->add('valeur_remise')
            ->add('type_remise')
            ->add('est_calcul_tranche')
            ->add('est_montant_quantite')
            ->add('rang_remise')
            ->add('est_desactive')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RemisePromotion::class,
        ]);
    }
}
