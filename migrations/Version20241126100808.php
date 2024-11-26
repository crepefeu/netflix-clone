<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241126100808 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE categories_media_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE languages_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE categories_media (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE languages (id INT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT fk_9474526cea9fdd75');
        $this->addSql('DROP INDEX idx_9474526cea9fdd75');
        $this->addSql('ALTER TABLE comment DROP media_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE categories_media_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE languages_id_seq CASCADE');
        $this->addSql('DROP TABLE categories_media');
        $this->addSql('DROP TABLE languages');
        $this->addSql('ALTER TABLE comment ADD media_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT fk_9474526cea9fdd75 FOREIGN KEY (media_id) REFERENCES media (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_9474526cea9fdd75 ON comment (media_id)');
    }
}
