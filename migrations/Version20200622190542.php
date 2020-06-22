<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200622190542 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribute DROP mysql_id');
        $this->addSql('ALTER TABLE category DROP mysql_id');
        $this->addSql('ALTER TABLE distributor DROP mysql_id');
        $this->addSql('ALTER TABLE film DROP mysql_id');
        $this->addSql('ALTER TABLE number DROP mysql_id');
        $this->addSql('ALTER TABLE person DROP mysql_id');
        $this->addSql('ALTER TABLE song DROP mysql_id');
        $this->addSql('ALTER TABLE studio DROP mysql_id');
        $this->addSql('ALTER TABLE "user" DROP mysql_id');
        $this->addSql('ALTER TABLE work ALTER target_uuid TYPE UUID USING target_uuid::uuid');
        $this->addSql('ALTER TABLE work ALTER target_uuid DROP DEFAULT');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE work ALTER target_uuid TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE work ALTER target_uuid DROP DEFAULT');
    }
}
