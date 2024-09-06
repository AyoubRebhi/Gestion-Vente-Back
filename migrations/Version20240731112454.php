<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240731112454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE acompte DROP CONSTRAINT fk_ce996bec6c0074e9');
        $this->addSql('DROP INDEX idx_ce996bec6c0074e9');
        $this->addSql('ALTER TABLE acompte ADD num_carte_fidalite VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE acompte ADD liste_articles JSON NOT NULL');
        $this->addSql('ALTER TABLE acompte ADD remise_globale DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE acompte ADD net_apayer DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE acompte ADD total_ttc DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE acompte ADD date_achat TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE acompte ADD bv VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE acompte DROP vente_id');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CE996BECAF74CFD3 ON acompte (bv)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX UNIQ_CE996BECAF74CFD3');
        $this->addSql('ALTER TABLE acompte ADD vente_id INT NOT NULL');
        $this->addSql('ALTER TABLE acompte DROP num_carte_fidalite');
        $this->addSql('ALTER TABLE acompte DROP liste_articles');
        $this->addSql('ALTER TABLE acompte DROP remise_globale');
        $this->addSql('ALTER TABLE acompte DROP net_apayer');
        $this->addSql('ALTER TABLE acompte DROP total_ttc');
        $this->addSql('ALTER TABLE acompte DROP date_achat');
        $this->addSql('ALTER TABLE acompte DROP bv');
        $this->addSql('ALTER TABLE acompte ADD CONSTRAINT fk_ce996bec6c0074e9 FOREIGN KEY (vente_id) REFERENCES vente (id_vente) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_ce996bec6c0074e9 ON acompte (vente_id)');
    }
}
