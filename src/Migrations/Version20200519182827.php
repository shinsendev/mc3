<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200519182827 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE category ADD contributors JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE song ADD contributors JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE number ADD contributors JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD contributors JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE attribute ADD contributors JSON DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE song DROP contributors');
        $this->addSql('ALTER TABLE person DROP contributors');
        $this->addSql('ALTER TABLE number DROP contributors');
        $this->addSql('ALTER TABLE category DROP contributors');
        $this->addSql('ALTER TABLE attribute DROP contributors');
    }
}
