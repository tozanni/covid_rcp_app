<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201015081138 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE user_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE user_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX user_log_class_lookup_idx ON user_log_entries (object_class)');
        $this->addSql('CREATE INDEX user_log_date_lookup_idx ON user_log_entries (logged_at)');
        $this->addSql('CREATE INDEX user_log_user_lookup_idx ON user_log_entries (username)');
        $this->addSql('CREATE INDEX user_log_version_lookup_idx ON user_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN user_log_entries.data IS \'(DC2Type:array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE user_log_entries_id_seq CASCADE');
        $this->addSql('DROP TABLE user_log_entries');
    }
}
