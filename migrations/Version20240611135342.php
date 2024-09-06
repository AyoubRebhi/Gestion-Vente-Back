<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240611135342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE vente_id_vente_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE vente (id_vente INT NOT NULL, id_client INT NOT NULL, liste_articles JSON NOT NULL, remise_globale DOUBLE PRECISION NOT NULL, net_apayer DOUBLE PRECISION NOT NULL, payer DOUBLE PRECISION NOT NULL, a_rendre DOUBLE PRECISION NOT NULL, total_ttc DOUBLE PRECISION NOT NULL, date_achat TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, bv VARCHAR(10) NOT NULL, PRIMARY KEY(id_vente))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_888A2A4CAF74CFD3 ON vente (bv)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE vente_id_vente_seq CASCADE');
        $this->addSql('DROP TABLE vente');
    }
}
