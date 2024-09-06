<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240807103542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Migrate bon_retour to use vente_id instead of bv';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bon_retour DROP CONSTRAINT fk_f913ab1baf74cfd3');
        $this->addSql('DROP INDEX idx_f913ab1baf74cfd3');
        $this->addSql('ALTER TABLE bon_retour ADD vente_id INT NOT NULL');
        $this->addSql('ALTER TABLE bon_retour DROP bv');
        $this->addSql('ALTER TABLE bon_retour ADD CONSTRAINT FK_F913AB1B7DC7170A FOREIGN KEY (vente_id) REFERENCES vente (id_vente) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F913AB1B7DC7170A ON bon_retour (vente_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE bon_retour DROP CONSTRAINT FK_F913AB1B7DC7170A');
        $this->addSql('DROP INDEX IDX_F913AB1B7DC7170A');
        $this->addSql('ALTER TABLE bon_retour ADD bv VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE bon_retour DROP vente_id');
        $this->addSql('ALTER TABLE bon_retour ADD CONSTRAINT fk_f913ab1baf74cfd3 FOREIGN KEY (bv) REFERENCES vente (bv) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_f913ab1baf74cfd3 ON bon_retour (bv)');
    }
}
