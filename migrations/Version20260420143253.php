<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260420143253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE soiree_artist (soiree_id INT NOT NULL, artist_id INT NOT NULL, INDEX IDX_60509CE7BA021F7B (soiree_id), INDEX IDX_60509CE7B7970CF8 (artist_id), PRIMARY KEY (soiree_id, artist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE soiree_artist ADD CONSTRAINT FK_60509CE7BA021F7B FOREIGN KEY (soiree_id) REFERENCES soiree (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE soiree_artist ADD CONSTRAINT FK_60509CE7B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soiree_artist DROP FOREIGN KEY FK_60509CE7BA021F7B');
        $this->addSql('ALTER TABLE soiree_artist DROP FOREIGN KEY FK_60509CE7B7970CF8');
        $this->addSql('DROP TABLE soiree_artist');
    }
}
