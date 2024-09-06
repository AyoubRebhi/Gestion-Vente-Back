<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240621091407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE collaborateur_pv_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE collaborateur_pv (id INT NOT NULL, nom_prenom VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, id_point_vente INT NOT NULL, cin VARCHAR(20) DEFAULT NULL, shift VARCHAR(50) NOT NULL, nb_heures DOUBLE PRECISION DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, est_bloque BOOLEAN NOT NULL, mdp VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN collaborateur_pv.created_at IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE collaborateur_pv_id_seq CASCADE');
        $this->addSql('DROP TABLE collaborateur_pv');
    }
}
