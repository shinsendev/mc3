<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200513211934 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE film_attribute (film_id INT NOT NULL, attribute_id INT NOT NULL, PRIMARY KEY(film_id, attribute_id))');
        $this->addSql('CREATE INDEX IDX_CEB6B1C8567F5183 ON film_attribute (film_id)');
        $this->addSql('CREATE INDEX IDX_CEB6B1C8B6E62EFA ON film_attribute (attribute_id)');
        $this->addSql('ALTER TABLE film_attribute ADD CONSTRAINT FK_CEB6B1C8567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film_attribute ADD CONSTRAINT FK_CEB6B1C8B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE film_attribute');
    }
}
