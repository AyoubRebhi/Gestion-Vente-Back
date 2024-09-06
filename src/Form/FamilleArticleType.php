<?php

namespace App\Form;

use App\Entity\FamilleArticle;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FamilleArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('est_service')
            ->add('libelle')
            ->add('code')
            ->add('est_default')
            ->add('est_desactive')
            ->add('cree_le', null, [
                'widget' => 'single_text',
            ])
            /*->add('cree_par', null, [
                'widget' => 'single_text',
            ])*/
            ->add('cree_par_id')
            ->add('modifier_le', null, [
                'widget' => 'single_text',
            ])
            ->add('modifier_par')
            ->add('modifier_par_id')
            ->add('est_predefini')
            ->add('conditionnement_vente_id')
            ->add('conditionnement_achat_id')
            ->add('est_gestion_stock')
            ->add('numero_serie_lot')
            ->add('coeff_marge')
            ->add('periode_garantie')
            ->add('contremarque')
            ->add('depot_favori')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FamilleArticle::class,
        ]);
    }
}
