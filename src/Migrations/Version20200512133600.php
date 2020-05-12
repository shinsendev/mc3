<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200512133600 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE qualification (id SERIAL NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE film ADD remake BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE film ADD sample BOOLEAN DEFAULT NULL');
        $this->addSql('ALTER TABLE film ADD stageshows JSON DEFAULT NULL');
        $this->addSql('ALTER TABLE film ADD viaf VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE film RENAME COLUMN comments TO pca');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE qualification');
        $this->addSql('ALTER TABLE film DROP remake');
        $this->addSql('ALTER TABLE film DROP sample');
        $this->addSql('ALTER TABLE film DROP stageshows');
        $this->addSql('ALTER TABLE film DROP viaf');
        $this->addSql('ALTER TABLE film RENAME COLUMN pca TO comments');
    }
}
