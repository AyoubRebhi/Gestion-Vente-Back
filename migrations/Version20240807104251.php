<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240807104251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bon_retour DROP CONSTRAINT FK_F913AB1B7DC7170A');
        $this->addSql('ALTER TABLE bon_retour ADD CONSTRAINT FK_F913AB1B7DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id_vente) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bon_retour DROP CONSTRAINT fk_f913ab1b7dc7170a');
        $this->addSql('ALTER TABLE bon_retour ADD CONSTRAINT fk_f913ab1b7dc7170a FOREIGN KEY (vente_id) REFERENCES vente (id_vente) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
