<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200520143651 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE song_number (song_id INT NOT NULL, number_id INT NOT NULL, PRIMARY KEY(song_id, number_id))');
        $this->addSql('CREATE INDEX IDX_90EB0EDEA0BDB2F3 ON song_number (song_id)');
        $this->addSql('CREATE INDEX IDX_90EB0EDE30A1DE10 ON song_number (number_id)');
        $this->addSql('ALTER TABLE song_number ADD CONSTRAINT FK_90EB0EDEA0BDB2F3 FOREIGN KEY (song_id) REFERENCES song (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE song_number ADD CONSTRAINT FK_90EB0EDE30A1DE10 FOREIGN KEY (number_id) REFERENCES number (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE song_number');
    }
}
