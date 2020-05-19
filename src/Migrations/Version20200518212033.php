<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200518212033 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE film_studio (film_id INT NOT NULL, studio_id INT NOT NULL, PRIMARY KEY(film_id, studio_id))');
        $this->addSql('CREATE INDEX IDX_21D93ABC567F5183 ON film_studio (film_id)');
        $this->addSql('CREATE INDEX IDX_21D93ABC446F285F ON film_studio (studio_id)');
        $this->addSql('CREATE TABLE film_distributor (film_id INT NOT NULL, distributor_id INT NOT NULL, PRIMARY KEY(film_id, distributor_id))');
        $this->addSql('CREATE INDEX IDX_DB7D7A7E567F5183 ON film_distributor (film_id)');
        $this->addSql('CREATE INDEX IDX_DB7D7A7E2D863A58 ON film_distributor (distributor_id)');
        $this->addSql('ALTER TABLE film_studio ADD CONSTRAINT FK_21D93ABC567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film_studio ADD CONSTRAINT FK_21D93ABC446F285F FOREIGN KEY (studio_id) REFERENCES studio (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film_distributor ADD CONSTRAINT FK_DB7D7A7E567F5183 FOREIGN KEY (film_id) REFERENCES film (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE film_distributor ADD CONSTRAINT FK_DB7D7A7E2D863A58 FOREIGN KEY (distributor_id) REFERENCES distributor (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE song DROP lyrics');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE film_studio');
        $this->addSql('DROP TABLE film_distributor');
        $this->addSql('ALTER TABLE song ADD lyrics TEXT DEFAULT NULL');
    }
}
