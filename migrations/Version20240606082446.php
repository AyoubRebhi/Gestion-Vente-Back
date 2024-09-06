<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240606082446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE point_de_vente_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE article (id INT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, prix_achat_ht DOUBLE PRECISION NOT NULL, prix_achat_ttc DOUBLE PRECISION NOT NULL, prix_vente_ht DOUBLE PRECISION NOT NULL, prix_vente_ttc DOUBLE PRECISION NOT NULL, est_affiche_ttc BOOLEAN NOT NULL, image VARCHAR(255) DEFAULT NULL, reference VARCHAR(255) NOT NULL, est_service BOOLEAN NOT NULL, cree_le TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, cree_par TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, modifier_le TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, modifier_par VARCHAR(255) DEFAULT NULL, est_supprime BOOLEAN DEFAULT NULL, est_bloque BOOLEAN DEFAULT NULL, code_barre VARCHAR(255) NOT NULL, periode_garentie INT DEFAULT NULL, fixe VARCHAR(255) DEFAULT NULL, coefficient DOUBLE PRECISION DEFAULT NULL, serie_lot VARCHAR(255) DEFAULT NULL, poids_net VARCHAR(255) DEFAULT NULL, poids_brut VARCHAR(255) DEFAULT NULL, qte_par_colis DOUBLE PRECISION DEFAULT NULL, est_desactive BOOLEAN DEFAULT NULL, cree_par_id INT DEFAULT NULL, modifier_par_id INT DEFAULT NULL, marque_id INT DEFAULT NULL, eco_participation_id INT DEFAULT NULL, tva_achat_id INT DEFAULT NULL, tva_vente_id INT DEFAULT NULL, tpf_achat_id INT DEFAULT NULL, tpf_vente_id INT DEFAULT NULL, conditionnement_achat_id INT DEFAULT NULL, conditionnement_vente_id INT DEFAULT NULL, est_divers BOOLEAN NOT NULL, est_publier_web BOOLEAN NOT NULL, est_contre_marque BOOLEAN NOT NULL, est_gestion_stock BOOLEAN NOT NULL, devise_id INT DEFAULT NULL, tva_id INT DEFAULT NULL, famille_article_id INT DEFAULT NULL, unite_id INT DEFAULT NULL, categorie_depense_id INT DEFAULT NULL, est_depense BOOLEAN DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN article.cree_le IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN article.cree_par IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN article.modifier_le IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE point_de_vente (id INT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, nb_caisse INT NOT NULL, nb_employe INT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN point_de_vente.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE article_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE point_de_vente_id_seq CASCADE');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE point_de_vente');
    }
}
