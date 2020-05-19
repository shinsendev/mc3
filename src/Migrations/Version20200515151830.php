<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200515151830 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE person ADD firstname VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD lastname VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD groupname VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE person ADD gender VARCHAR(5) DEFAULT NULL');
        $this->addSql('ALTER TABLE person ADD viaf VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE person DROP firstname');
        $this->addSql('ALTER TABLE person DROP lastname');
        $this->addSql('ALTER TABLE person DROP groupname');
        $this->addSql('ALTER TABLE person DROP gender');
        $this->addSql('ALTER TABLE person DROP viaf');
    }
}
