<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240626100953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE point_de_vente ALTER COLUMN horaire_ouverture TYPE TEXT USING horaire_ouverture::TEXT');
        $this->addSql('ALTER TABLE point_de_vente ALTER COLUMN horaire_fermeture TYPE TEXT USING horaire_fermeture::TEXT');

        $this->addSql('ALTER TABLE point_de_vente ALTER COLUMN horaire_ouverture TYPE TIMESTAMP(0) WITHOUT TIME ZONE USING horaire_ouverture::TIMESTAMP');
        $this->addSql('ALTER TABLE point_de_vente ALTER COLUMN horaire_fermeture TYPE TIMESTAMP(0) WITHOUT TIME ZONE USING horaire_fermeture::TIMESTAMP');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE point_de_vente ALTER COLUMN horaire_ouverture TYPE TEXT USING horaire_ouverture::TEXT');
        $this->addSql('ALTER TABLE point_de_vente ALTER COLUMN horaire_fermeture TYPE TEXT USING horaire_fermeture::TEXT');

        $this->addSql('ALTER TABLE point_de_vente ALTER COLUMN horaire_ouverture TYPE TIME(0) WITHOUT TIME ZONE USING horaire_ouverture::TIME');
        $this->addSql('ALTER TABLE point_de_vente ALTER COLUMN horaire_fermeture TYPE TIME(0) WITHOUT TIME ZONE USING horaire_fermeture::TIME');
    }
}
