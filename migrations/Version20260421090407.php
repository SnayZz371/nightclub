<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260421090407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE materiel (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE TABLE materiel_soiree (id INT AUTO_INCREMENT NOT NULL, date_reservation_debut DATE DEFAULT NULL, date_reservation_fin DATE DEFAULT NULL, materiel_id INT DEFAULT NULL, soiree_id INT DEFAULT NULL, INDEX IDX_DFC1EAE516880AAF (materiel_id), INDEX IDX_DFC1EAE5BA021F7B (soiree_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE materiel_soiree ADD CONSTRAINT FK_DFC1EAE516880AAF FOREIGN KEY (materiel_id) REFERENCES materiel (id)');
        $this->addSql('ALTER TABLE materiel_soiree ADD CONSTRAINT FK_DFC1EAE5BA021F7B FOREIGN KEY (soiree_id) REFERENCES soiree (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE materiel_soiree DROP FOREIGN KEY FK_DFC1EAE516880AAF');
        $this->addSql('ALTER TABLE materiel_soiree DROP FOREIGN KEY FK_DFC1EAE5BA021F7B');
        $this->addSql('DROP TABLE materiel');
        $this->addSql('DROP TABLE materiel_soiree');
    }
}
