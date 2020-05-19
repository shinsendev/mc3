<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200514191537 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE number_attribute (number_id INT NOT NULL, attribute_id INT NOT NULL, PRIMARY KEY(number_id, attribute_id))');
        $this->addSql('CREATE INDEX IDX_D7F8128330A1DE10 ON number_attribute (number_id)');
        $this->addSql('CREATE INDEX IDX_D7F81283B6E62EFA ON number_attribute (attribute_id)');
        $this->addSql('ALTER TABLE number_attribute ADD CONSTRAINT FK_D7F8128330A1DE10 FOREIGN KEY (number_id) REFERENCES number (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE number_attribute ADD CONSTRAINT FK_D7F81283B6E62EFA FOREIGN KEY (attribute_id) REFERENCES attribute (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE number_attribute');
    }
}
