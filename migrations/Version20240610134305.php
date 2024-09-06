<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240610134305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE remise_promotion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE remise_promotion (id INT NOT NULL, libelle VARCHAR(50) NOT NULL, remise_article VARCHAR(10) NOT NULL, remise_client VARCHAR(10) NOT NULL, est_inclure_description BOOLEAN NOT NULL, article_offert INT NOT NULL, date_debut TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_fin TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, valeur_remise VARCHAR(25) NOT NULL, type_remise VARCHAR(10) NOT NULL, est_calcul_tranche BOOLEAN NOT NULL, est_montant_quantite BOOLEAN NOT NULL, rang_remise INT NOT NULL, est_desactive BOOLEAN NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE remise_promotion_id_seq CASCADE');
        $this->addSql('DROP TABLE remise_promotion');
    }
}
