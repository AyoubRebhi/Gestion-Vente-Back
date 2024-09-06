<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    { 
        $builder
            ->add('nom')
            //->add('description')
            ->add('prix_achat_ht')
            ->add('prix_achat_ttc')
            ->add('prix_vente_ht')
            ->add('prix_vente_ttc')
            ->add('est_affiche_ttc')
            //->add('image')
            ->add('reference')
            ->add('est_service')
            /*->add('cree_le', null, [
                'widget' => 'single_text',
            ])
            ->add('cree_par', null, [
                'widget' => 'single_text',
            ])
            ->add('modifier_le', null, [
                'widget' => 'single_text',
            ])
            ->add('modifier_par')
            ->add('est_supprime')
            ->add('est_bloque')*/
            ->add('code_barre')
            /*->add('periode_garentie')
            ->add('fixe')
            ->add('coefficient')
            ->add('serie_lot')
            ->add('poids_net')
            ->add('poids_brut')
            ->add('qte_par_colis')
            ->add('est_desactive')
            ->add('cree_par_id')
            ->add('modifier_par_id')
            ->add('marque_id')
            ->add('eco_participation_id')
            ->add('tva_achat_id')
            ->add('tva_vente_id')
            ->add('tpf_achat_id')
            ->add('tpf_vente_id')
            ->add('conditionnement_achat_id')
            ->add('conditionnement_vente_id')*/
            ->add('est_divers')
            ->add('est_publier_web')
            ->add('est_contre_marque')
            ->add('est_gestion_stock')
            /*->add('devise_id')
            ->add('tva_id')
            ->add('famille_article_id')
            ->add('unite_id')
            ->add('categorie_depense_id')
            ->add('est_depense')*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
