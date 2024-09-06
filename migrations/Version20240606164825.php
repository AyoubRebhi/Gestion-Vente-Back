<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240606164825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE client_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE client (id INT NOT NULL, nom_prenom VARCHAR(255) NOT NULL, cin VARCHAR(10) NOT NULL, num_carte_fidalite VARCHAR(20) DEFAULT NULL, num_tel VARCHAR(14) NOT NULL, date_naissance DATE NOT NULL, points_carte_fidalite INT DEFAULT NULL, cree_le TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, est_desactive BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN client.date_naissance IS \'(DC2Type:date_immutable)\'');
        $this->addSql('COMMENT ON COLUMN client.cree_le IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE article ALTER cree_par TYPE VARCHAR(255)');
        $this->addSql('COMMENT ON COLUMN article.cree_par IS NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE client_id_seq CASCADE');
        $this->addSql('DROP TABLE client');
        $this->addSql('ALTER TABLE article ALTER cree_par TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('COMMENT ON COLUMN article.cree_par IS \'(DC2Type:datetime_immutable)\'');
    }
}
