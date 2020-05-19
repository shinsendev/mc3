<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200518155752 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('DROP SEQUENCE work_id_seq CASCADE');
        $this->addSql('ALTER TABLE work ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE work DROP id');
        $this->addSql('ALTER TABLE work RENAME COLUMN profession TO target_uuid');
        $this->addSql('ALTER TABLE work ADD PRIMARY KEY (person_id, target_uuid)');
        $this->addSql('ALTER TABLE film DROP mysql_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE work_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('DROP INDEX work_pkey');
        $this->addSql('ALTER TABLE work ADD id SERIAL NOT NULL');
        $this->addSql('ALTER TABLE work DROP created_at');
        $this->addSql('ALTER TABLE work RENAME COLUMN target_uuid TO profession');
        $this->addSql('ALTER TABLE work ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE film ADD mysql_id INT DEFAULT NULL');
    }
}
