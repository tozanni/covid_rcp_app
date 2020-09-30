<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200930061355 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create sessions and revisions tables';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE session_sess_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE revisions_id_seq CASCADE');
        $this->addSql('DROP TABLE sessions');
        $this->addSql('DROP TABLE revisions');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE session_sess_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE revisions_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE sessions (sess_id VARCHAR(128) NOT NULL, sess_data BYTEA NOT NULL, sess_time INT NOT NULL, sess_lifetime INT NOT NULL, PRIMARY KEY(sess_id))');
        $this->addSql('CREATE TABLE revisions (id SERIAL NOT NULL, "timestamp" TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
    }
}
