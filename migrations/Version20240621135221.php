<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240621135221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE client_id_client_seq CASCADE');
        $this->addSql('DROP SEQUENCE collaborateur_pv_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE client_pv_id_client_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE utilisateur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE utilisateur (id INT NOT NULL, forme_juridique_id INT DEFAULT NULL, mode_reglement_id INT DEFAULT NULL, risque_id INT DEFAULT NULL, famille_id INT DEFAULT NULL, code VARCHAR(15) NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, telephone VARCHAR(20) DEFAULT NULL, poratble VARCHAR(20) DEFAULT NULL, site_web VARCHAR(255) DEFAULT NULL, numero_tva VARCHAR(20) DEFAULT NULL, est_bloquer BOOLEAN NOT NULL, linkedin VARCHAR(50) NOT NULL, facebook VARCHAR(50) NOT NULL, facturation BOOLEAN NOT NULL, rc VARCHAR(20) NOT NULL, code_naf VARCHAR(20) NOT NULL, est_commande_obligatoire BOOLEAN NOT NULL, est_pospect BOOLEAN NOT NULL, siret VARCHAR(50) DEFAULT NULL, encour DOUBLE PRECISION NOT NULL, autoriser DOUBLE PRECISION NOT NULL, est_adresse_facturation BOOLEAN NOT NULL, cree_le TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, cree_par VARCHAR(50) DEFAULT NULL, cree_par_id INT DEFAULT NULL, modifier_le TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, modifier_par VARCHAR(50) DEFAULT NULL, modifier_par_id INT DEFAULT NULL, est_supprime BOOLEAN NOT NULL, est_desactive BOOLEAN NOT NULL, est_bloque BOOLEAN NOT NULL, libelle_tarif_id INT NOT NULL, domaine_activite_id INT DEFAULT NULL, remise_global DOUBLE PRECISION DEFAULT NULL, remise_par_ligne DOUBLE PRECISION DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, regime_tva_id INT DEFAULT NULL, reference VARCHAR(50) DEFAULT NULL, est_assujetti_tpf BOOLEAN NOT NULL, affaire INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE collaborateur_pv');
        $this->addSql('ALTER INDEX uniq_c7440455abe530da RENAME TO UNIQ_7152B171ABE530DA');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE client_pv_id_client_seq CASCADE');
        $this->addSql('DROP SEQUENCE utilisateur_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE client_id_client_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE collaborateur_pv_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE collaborateur_pv (id INT NOT NULL, nom_prenom VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, id_point_vente INT NOT NULL, cin VARCHAR(20) DEFAULT NULL, shift VARCHAR(50) NOT NULL, nb_heures DOUBLE PRECISION DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, est_bloque BOOLEAN NOT NULL, mdp VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN collaborateur_pv.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('ALTER INDEX uniq_7152b171abe530da RENAME TO uniq_c7440455abe530da');
    }
}
