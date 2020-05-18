<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200516233304 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE song_comment (song_id INT NOT NULL, comment_id INT NOT NULL, PRIMARY KEY(song_id, comment_id))');
        $this->addSql('CREATE INDEX IDX_991F4343A0BDB2F3 ON song_comment (song_id)');
        $this->addSql('CREATE INDEX IDX_991F4343F8697D13 ON song_comment (comment_id)');
        $this->addSql('CREATE TABLE number_comment (number_id INT NOT NULL, comment_id INT NOT NULL, PRIMARY KEY(number_id, comment_id))');
        $this->addSql('CREATE INDEX IDX_E3E666F930A1DE10 ON number_comment (number_id)');
        $this->addSql('CREATE INDEX IDX_E3E666F9F8697D13 ON number_comment (comment_id)');
        $this->addSql('CREATE TABLE film_comment (film_id INT NOT NULL, comment_id INT NOT NULL, PRIMARY KEY(film_id, comment_id))');
        $this->addSql('CREATE INDEX IDX_74CA494F567F5183 ON film_comment (film_id)');
        $this->addSql('CREATE INDEX IDX_74CA494FF8697D13 ON film_comment (comment_id)');
        $this->addSql('ALTER TABLE song_comment ADD CONSTRAINT FK_991F4343A0BDB2F3 FOREIGN KEY (song_id) REFERENCES song (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE song_comment ADD CONSTRAINT FK_991F4343F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE number_comment ADD CONSTRAINT FK_E3E666F930A1DE10 FOREIGN KEY (number_id) REFERENCES number (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE number_comment ADD CONSTRAINT FK_E3E666F9F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film_comment ADD CONSTRAINT FK_74CA494F567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film_comment ADD CONSTRAINT FK_74CA494FF8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE song_comment');
        $this->addSql('DROP TABLE number_comment');
        $this->addSql('DROP TABLE film_comment');
    }
}
