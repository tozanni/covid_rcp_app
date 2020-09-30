<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200930074232 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Create arterial_blood_gas and cardiac_enzymes tables';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE arterial_blood_gas_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE cardiac_enzymes_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE arterial_blood_gas (id UUID NOT NULL, ph DOUBLE PRECISION DEFAULT NULL, o2 DOUBLE PRECISION DEFAULT NULL, co2 DOUBLE PRECISION DEFAULT NULL, hco3 DOUBLE PRECISION DEFAULT NULL, be DOUBLE PRECISION DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN arterial_blood_gas.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN arterial_blood_gas.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN arterial_blood_gas.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE arterial_blood_gas_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX arterial_blood_gas_log_class_lookup_idx ON arterial_blood_gas_log_entries (object_class)');
        $this->addSql('CREATE INDEX arterial_blood_gas_log_date_lookup_idx ON arterial_blood_gas_log_entries (logged_at)');
        $this->addSql('CREATE INDEX arterial_blood_gas_log_user_lookup_idx ON arterial_blood_gas_log_entries (username)');
        $this->addSql('CREATE INDEX arterial_blood_gas_log_version_lookup_idx ON arterial_blood_gas_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN arterial_blood_gas_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE cardiac_enzymes (id UUID NOT NULL, cpk DOUBLE PRECISION DEFAULT NULL, mioglobin DOUBLE PRECISION DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN cardiac_enzymes.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN cardiac_enzymes.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN cardiac_enzymes.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE cardiac_enzymes_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX cardiac_enzymes_log_class_lookup_idx ON cardiac_enzymes_log_entries (object_class)');
        $this->addSql('CREATE INDEX cardiac_enzymes_log_date_lookup_idx ON cardiac_enzymes_log_entries (logged_at)');
        $this->addSql('CREATE INDEX cardiac_enzymes_log_user_lookup_idx ON cardiac_enzymes_log_entries (username)');
        $this->addSql('CREATE INDEX cardiac_enzymes_log_version_lookup_idx ON cardiac_enzymes_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN cardiac_enzymes_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE hematic_biometry ADD lymphocytes DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE hematic_biometry ADD neutrophils DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE immunological ADD procalcitonin DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE immunological ADD d_dimer DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE record ADD arterial_blood_gas_id UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE record ADD cardiac_enzymes_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN record.arterial_blood_gas_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN record.cardiac_enzymes_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F91E04D1BFD FOREIGN KEY (arterial_blood_gas_id) REFERENCES arterial_blood_gas (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F91A9C86E2B FOREIGN KEY (cardiac_enzymes_id) REFERENCES cardiac_enzymes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B349F91E04D1BFD ON record (arterial_blood_gas_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B349F91A9C86E2B ON record (cardiac_enzymes_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE record DROP CONSTRAINT FK_9B349F91E04D1BFD');
        $this->addSql('ALTER TABLE record DROP CONSTRAINT FK_9B349F91A9C86E2B');
        $this->addSql('DROP SEQUENCE arterial_blood_gas_log_entries_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE cardiac_enzymes_log_entries_id_seq CASCADE');
        $this->addSql('DROP TABLE arterial_blood_gas');
        $this->addSql('DROP TABLE arterial_blood_gas_log_entries');
        $this->addSql('DROP TABLE cardiac_enzymes');
        $this->addSql('DROP TABLE cardiac_enzymes_log_entries');
        $this->addSql('DROP INDEX UNIQ_9B349F91E04D1BFD');
        $this->addSql('DROP INDEX UNIQ_9B349F91A9C86E2B');
        $this->addSql('ALTER TABLE record DROP arterial_blood_gas_id');
        $this->addSql('ALTER TABLE record DROP cardiac_enzymes_id');
        $this->addSql('ALTER TABLE hematic_biometry DROP lymphocytes');
        $this->addSql('ALTER TABLE hematic_biometry DROP neutrophils');
        $this->addSql('ALTER TABLE immunological DROP procalcitonin');
        $this->addSql('ALTER TABLE immunological DROP d_dimer');
    }
}
