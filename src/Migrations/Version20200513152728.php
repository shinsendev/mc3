<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200513152728 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER TABLE attribute ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE attribute ADD title VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE attribute ADD description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE attribute ADD example TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE attribute ADD linked_entity_type VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE attribute ALTER id DROP DEFAULT');
        $this->addSql('ALTER TABLE attribute ADD CONSTRAINT FK_FA7AEFFB12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_FA7AEFFB12469DE2 ON attribute (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE attribute DROP CONSTRAINT FK_FA7AEFFB12469DE2');
        $this->addSql('DROP INDEX IDX_FA7AEFFB12469DE2');
        $this->addSql('ALTER TABLE attribute DROP category_id');
        $this->addSql('ALTER TABLE attribute DROP title');
        $this->addSql('ALTER TABLE attribute DROP description');
        $this->addSql('ALTER TABLE attribute DROP example');
        $this->addSql('ALTER TABLE attribute DROP linked_entity_type');
        $this->addSql('CREATE SEQUENCE attribute_id_seq');
        $this->addSql('SELECT setval(\'attribute_id_seq\', (SELECT MAX(id) FROM attribute))');
        $this->addSql('ALTER TABLE attribute ALTER id SET DEFAULT nextval(\'attribute_id_seq\')');
    }
}
