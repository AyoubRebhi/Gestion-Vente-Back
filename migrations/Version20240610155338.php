<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240610155338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE famille_article_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE famille_article (id INT NOT NULL, est_service BOOLEAN NOT NULL, libelle VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, est_default BOOLEAN NOT NULL, est_desactive BOOLEAN NOT NULL, cree_le TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, cree_par TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, cree_par_id INT NOT NULL, modifier_le TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modifier_par VARCHAR(50) NOT NULL, modifier_par_id INT NOT NULL, est_predefini BOOLEAN NOT NULL, conditionnement_vente_id INT NOT NULL, conditionnement_achat_id INT NOT NULL, est_gestion_stock BOOLEAN NOT NULL, numero_serie_lot VARCHAR(7) NOT NULL, coeff_marge DOUBLE PRECISION NOT NULL, periode_garantie INT NOT NULL, contremarque BOOLEAN NOT NULL, depot_favori INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE client DROP image');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE famille_article_id_seq CASCADE');
        $this->addSql('DROP TABLE famille_article');
        $this->addSql('ALTER TABLE client ADD image VARCHAR(255) DEFAULT NULL');
    }
}
