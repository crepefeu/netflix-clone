<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241126104031 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT fk_9474526cb9b3f2a8');
        $this->addSql('DROP INDEX idx_9474526cb9b3f2a8');
        $this->addSql('ALTER TABLE comment ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE comment ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE comment RENAME COLUMN child_comments_id TO parent_id');
        $this->addSql('COMMENT ON COLUMN comment.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN comment.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C727ACA70 FOREIGN KEY (parent_id) REFERENCES comment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9474526C727ACA70 ON comment (parent_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE comment DROP CONSTRAINT FK_9474526C727ACA70');
        $this->addSql('DROP INDEX IDX_9474526C727ACA70');
        $this->addSql('ALTER TABLE comment DROP created_at');
        $this->addSql('ALTER TABLE comment DROP updated_at');
        $this->addSql('ALTER TABLE comment RENAME COLUMN parent_id TO child_comments_id');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT fk_9474526cb9b3f2a8 FOREIGN KEY (child_comments_id) REFERENCES comment (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_9474526cb9b3f2a8 ON comment (child_comments_id)');
    }
}
