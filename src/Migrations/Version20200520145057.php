<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200520145057 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE number_song (number_id INT NOT NULL, song_id INT NOT NULL, PRIMARY KEY(number_id, song_id))');
        $this->addSql('CREATE INDEX IDX_7129251430A1DE10 ON number_song (number_id)');
        $this->addSql('CREATE INDEX IDX_71292514A0BDB2F3 ON number_song (song_id)');
        $this->addSql('ALTER TABLE number_song ADD CONSTRAINT FK_7129251430A1DE10 FOREIGN KEY (number_id) REFERENCES number (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE number_song ADD CONSTRAINT FK_71292514A0BDB2F3 FOREIGN KEY (song_id) REFERENCES song (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE song_number');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE song_number (song_id INT NOT NULL, number_id INT NOT NULL, PRIMARY KEY(song_id, number_id))');
        $this->addSql('CREATE INDEX idx_90eb0ede30a1de10 ON song_number (number_id)');
        $this->addSql('CREATE INDEX idx_90eb0edea0bdb2f3 ON song_number (song_id)');
        $this->addSql('ALTER TABLE song_number ADD CONSTRAINT fk_90eb0edea0bdb2f3 FOREIGN KEY (song_id) REFERENCES song (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE song_number ADD CONSTRAINT fk_90eb0ede30a1de10 FOREIGN KEY (number_id) REFERENCES number (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE number_song');
    }
}
