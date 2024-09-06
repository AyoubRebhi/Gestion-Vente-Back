<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240621082843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE point_de_vente ADD horaire_ouverture TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE point_de_vente ADD horaire_fermeture TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE point_de_vente ADD jour_de_travail VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE point_de_vente ADD liste_utilisateur JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE point_de_vente DROP horaire_ouverture');
        $this->addSql('ALTER TABLE point_de_vente DROP horaire_fermeture');
        $this->addSql('ALTER TABLE point_de_vente DROP jour_de_travail');
        $this->addSql('ALTER TABLE point_de_vente DROP liste_utilisateur');
    }
}
