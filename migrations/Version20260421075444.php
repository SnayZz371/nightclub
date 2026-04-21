<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260421075444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE soiree ADD theme_soiree VARCHAR(255) NOT NULL, ADD theme_soiree_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE soiree ADD CONSTRAINT FK_131F30D274C1C5F6 FOREIGN KEY (theme_soiree_id) REFERENCES theme (id)');
        $this->addSql('CREATE INDEX IDX_131F30D274C1C5F6 ON soiree (theme_soiree_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE theme');
        $this->addSql('ALTER TABLE soiree DROP FOREIGN KEY FK_131F30D274C1C5F6');
        $this->addSql('DROP INDEX IDX_131F30D274C1C5F6 ON soiree');
        $this->addSql('ALTER TABLE soiree DROP theme_soiree, DROP theme_soiree_id');
    }
}
