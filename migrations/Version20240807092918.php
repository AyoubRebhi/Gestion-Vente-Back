<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240807092918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE acompte_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE bon_retour_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bon_retour (id INT NOT NULL, bv VARCHAR(10) NOT NULL, num_carte_fidalite VARCHAR(20) NOT NULL, articles_retours JSON NOT NULL, total_retour DOUBLE PRECISION NOT NULL, remboursement DOUBLE PRECISION NOT NULL, date_retour TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F913AB1BAF74CFD3 ON bon_retour (bv)');
        $this->addSql('ALTER TABLE bon_retour ADD CONSTRAINT FK_F913AB1BAF74CFD3 FOREIGN KEY (bv) REFERENCES vente (BV) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE acompte');
        $this->addSql('ALTER TABLE vente ALTER acompte DROP DEFAULT');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE bon_retour_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE acompte_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE acompte (id INT NOT NULL, montant_deja_verse DOUBLE PRECISION NOT NULL, reste_apayer DOUBLE PRECISION NOT NULL, date_limite DATE NOT NULL, num_carte_fidalite VARCHAR(20) NOT NULL, liste_articles JSON NOT NULL, remise_globale DOUBLE PRECISION NOT NULL, net_apayer DOUBLE PRECISION NOT NULL, total_ttc DOUBLE PRECISION NOT NULL, date_achat TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, bv VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_ce996becaf74cfd3 ON acompte (bv)');
        $this->addSql('ALTER TABLE bon_retour DROP CONSTRAINT FK_F913AB1BAF74CFD3');
        $this->addSql('DROP TABLE bon_retour');
        $this->addSql('ALTER TABLE vente ALTER acompte SET DEFAULT \'0.0\'');
    }
}
