<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240624105442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE caisse_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE caisse (id INT NOT NULL, point_de_vente_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B2A353C83F95E273 ON caisse (point_de_vente_id)');
        $this->addSql('ALTER TABLE caisse ADD CONSTRAINT FK_B2A353C83F95E273 FOREIGN KEY (point_de_vente_id) REFERENCES point_de_vente (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE point_de_vente DROP liste_utilisateur');
        $this->addSql('ALTER TABLE utilisateur ADD point_de_vente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD caisse_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B33F95E273 FOREIGN KEY (point_de_vente_id) REFERENCES point_de_vente (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B327B4FEBF FOREIGN KEY (caisse_id) REFERENCES caisse (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_1D1C63B33F95E273 ON utilisateur (point_de_vente_id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B327B4FEBF ON utilisateur (caisse_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE utilisateur DROP CONSTRAINT FK_1D1C63B327B4FEBF');
        $this->addSql('DROP SEQUENCE caisse_id_seq CASCADE');
        $this->addSql('ALTER TABLE caisse DROP CONSTRAINT FK_B2A353C83F95E273');
        $this->addSql('DROP TABLE caisse');
        $this->addSql('ALTER TABLE point_de_vente ADD liste_utilisateur JSON NOT NULL');
        $this->addSql('ALTER TABLE utilisateur DROP CONSTRAINT FK_1D1C63B33F95E273');
        $this->addSql('DROP INDEX IDX_1D1C63B33F95E273');
        $this->addSql('DROP INDEX IDX_1D1C63B327B4FEBF');
        $this->addSql('ALTER TABLE utilisateur DROP point_de_vente_id');
        $this->addSql('ALTER TABLE utilisateur DROP caisse_id');
    }
}
