<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240627103416 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add Acompte entity and update Vente entity with foreign key reference to id_vente.';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE acompte_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE acompte (id INT NOT NULL, vente_id INT NOT NULL, montant_deja_verse DOUBLE PRECISION NOT NULL, reste_apayer DOUBLE PRECISION NOT NULL, date_limite DATE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CE996BEC6C0074E9 ON acompte (vente_id)');
        $this->addSql('ALTER TABLE acompte ADD CONSTRAINT FK_CE996BEC6C0074E9 FOREIGN KEY (vente_id) REFERENCES vente (id_vente) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE acompte');
        $this->addSql('DROP SEQUENCE acompte_id_seq');
    }
}
