<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200518185930 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE song ADD external_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE song DROP mysql_id');
        $this->addSql('ALTER TABLE number DROP mysql_id');
        $this->addSql('ALTER TABLE person DROP mysql_id');
        $this->addSql('ALTER TABLE film DROP mysql_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE song ADD mysql_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE song DROP external_id');
        $this->addSql('ALTER TABLE person ADD mysql_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE number ADD mysql_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE film ADD mysql_id INT DEFAULT NULL');
    }
}
