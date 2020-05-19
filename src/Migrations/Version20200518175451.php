<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200518175451 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE work (id SERIAL NOT NULL, person_id INT NOT NULL, target_uuid VARCHAR(255) NOT NULL, target_type VARCHAR(255) NOT NULL, profession VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX work_idx ON work (person_id, target_uuid, target_type, profession)');
        $this->addSql('ALTER TABLE person DROP mysql_id');
        $this->addSql('ALTER TABLE film DROP mysql_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE work');
        $this->addSql('ALTER TABLE person ADD mysql_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE film ADD mysql_id INT DEFAULT NULL');
    }
}
