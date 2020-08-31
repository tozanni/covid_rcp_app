<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200831201453 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE blood_chemistry_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE clotting_time_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE covid_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE hematic_biometry_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE imaging_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE immunological_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE liver_function_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE medical_notes_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE record_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE serum_electrolytes_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE triage_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE vital_signs_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE blood_chemistry_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX blood_chemistry_log_class_lookup_idx ON blood_chemistry_log_entries (object_class)');
        $this->addSql('CREATE INDEX blood_chemistry_log_date_lookup_idx ON blood_chemistry_log_entries (logged_at)');
        $this->addSql('CREATE INDEX blood_chemistry_log_user_lookup_idx ON blood_chemistry_log_entries (username)');
        $this->addSql('CREATE INDEX blood_chemistry_log_version_lookup_idx ON blood_chemistry_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN blood_chemistry_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE clotting_time_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX clotting_time_log_class_lookup_idx ON clotting_time_log_entries (object_class)');
        $this->addSql('CREATE INDEX clotting_time_log_date_lookup_idx ON clotting_time_log_entries (logged_at)');
        $this->addSql('CREATE INDEX clotting_time_log_user_lookup_idx ON clotting_time_log_entries (username)');
        $this->addSql('CREATE INDEX clotting_time_log_version_lookup_idx ON clotting_time_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN clotting_time_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE covid (id UUID NOT NULL, pcr BOOLEAN DEFAULT NULL, ldh DOUBLE PRECISION DEFAULT NULL, il_6 DOUBLE PRECISION DEFAULT NULL, ferritin DOUBLE PRECISION DEFAULT NULL, troponin DOUBLE PRECISION DEFAULT NULL, igm DOUBLE PRECISION DEFAULT NULL, igg DOUBLE PRECISION DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN covid.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE covid_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX covid_log_class_lookup_idx ON covid_log_entries (object_class)');
        $this->addSql('CREATE INDEX covid_log_date_lookup_idx ON covid_log_entries (logged_at)');
        $this->addSql('CREATE INDEX covid_log_user_lookup_idx ON covid_log_entries (username)');
        $this->addSql('CREATE INDEX covid_log_version_lookup_idx ON covid_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN covid_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE hematic_biometry_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX hematic_biometry_log_class_lookup_idx ON hematic_biometry_log_entries (object_class)');
        $this->addSql('CREATE INDEX hematic_biometry_log_date_lookup_idx ON hematic_biometry_log_entries (logged_at)');
        $this->addSql('CREATE INDEX hematic_biometry_log_user_lookup_idx ON hematic_biometry_log_entries (username)');
        $this->addSql('CREATE INDEX hematic_biometry_log_version_lookup_idx ON hematic_biometry_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN hematic_biometry_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE imaging_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX imaging_log_class_lookup_idx ON imaging_log_entries (object_class)');
        $this->addSql('CREATE INDEX imaging_log_date_lookup_idx ON imaging_log_entries (logged_at)');
        $this->addSql('CREATE INDEX imaging_log_user_lookup_idx ON imaging_log_entries (username)');
        $this->addSql('CREATE INDEX imaging_log_version_lookup_idx ON imaging_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN imaging_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE immunological_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX immunological_log_class_lookup_idx ON immunological_log_entries (object_class)');
        $this->addSql('CREATE INDEX immunological_log_date_lookup_idx ON immunological_log_entries (logged_at)');
        $this->addSql('CREATE INDEX immunological_log_user_lookup_idx ON immunological_log_entries (username)');
        $this->addSql('CREATE INDEX immunological_log_version_lookup_idx ON immunological_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN immunological_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE liver_function_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX liver_function_log_class_lookup_idx ON liver_function_log_entries (object_class)');
        $this->addSql('CREATE INDEX liver_function_log_date_lookup_idx ON liver_function_log_entries (logged_at)');
        $this->addSql('CREATE INDEX liver_function_log_user_lookup_idx ON liver_function_log_entries (username)');
        $this->addSql('CREATE INDEX liver_function_log_version_lookup_idx ON liver_function_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN liver_function_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE medical_notes_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX medical_notes_log_class_lookup_idx ON medical_notes_log_entries (object_class)');
        $this->addSql('CREATE INDEX medical_notes_log_date_lookup_idx ON medical_notes_log_entries (logged_at)');
        $this->addSql('CREATE INDEX medical_notes_log_user_lookup_idx ON medical_notes_log_entries (username)');
        $this->addSql('CREATE INDEX medical_notes_log_version_lookup_idx ON medical_notes_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN medical_notes_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE record_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX record_log_class_lookup_idx ON record_log_entries (object_class)');
        $this->addSql('CREATE INDEX record_log_date_lookup_idx ON record_log_entries (logged_at)');
        $this->addSql('CREATE INDEX record_log_user_lookup_idx ON record_log_entries (username)');
        $this->addSql('CREATE INDEX record_log_version_lookup_idx ON record_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN record_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE serum_electrolytes_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX serum_electrolytes_log_class_lookup_idx ON serum_electrolytes_log_entries (object_class)');
        $this->addSql('CREATE INDEX serum_electrolytes_log_date_lookup_idx ON serum_electrolytes_log_entries (logged_at)');
        $this->addSql('CREATE INDEX serum_electrolytes_log_user_lookup_idx ON serum_electrolytes_log_entries (username)');
        $this->addSql('CREATE INDEX serum_electrolytes_log_version_lookup_idx ON serum_electrolytes_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN serum_electrolytes_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE triage_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX triage_log_class_lookup_idx ON triage_log_entries (object_class)');
        $this->addSql('CREATE INDEX triage_log_date_lookup_idx ON triage_log_entries (logged_at)');
        $this->addSql('CREATE INDEX triage_log_user_lookup_idx ON triage_log_entries (username)');
        $this->addSql('CREATE INDEX triage_log_version_lookup_idx ON triage_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN triage_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE vital_signs_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX vital_signs_log_class_lookup_idx ON vital_signs_log_entries (object_class)');
        $this->addSql('CREATE INDEX vital_signs_log_date_lookup_idx ON vital_signs_log_entries (logged_at)');
        $this->addSql('CREATE INDEX vital_signs_log_user_lookup_idx ON vital_signs_log_entries (username)');
        $this->addSql('CREATE INDEX vital_signs_log_version_lookup_idx ON vital_signs_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN vital_signs_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE record ADD covid_id UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN record.covid_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F9122A5C3AB FOREIGN KEY (covid_id) REFERENCES covid (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B349F9122A5C3AB ON record (covid_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE record DROP CONSTRAINT FK_9B349F9122A5C3AB');
        $this->addSql('DROP SEQUENCE blood_chemistry_log_entries_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE clotting_time_log_entries_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE covid_log_entries_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE hematic_biometry_log_entries_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE imaging_log_entries_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE immunological_log_entries_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE liver_function_log_entries_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE medical_notes_log_entries_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE record_log_entries_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE serum_electrolytes_log_entries_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE triage_log_entries_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE vital_signs_log_entries_id_seq CASCADE');
        $this->addSql('DROP TABLE blood_chemistry_log_entries');
        $this->addSql('DROP TABLE clotting_time_log_entries');
        $this->addSql('DROP TABLE covid');
        $this->addSql('DROP TABLE covid_log_entries');
        $this->addSql('DROP TABLE hematic_biometry_log_entries');
        $this->addSql('DROP TABLE imaging_log_entries');
        $this->addSql('DROP TABLE immunological_log_entries');
        $this->addSql('DROP TABLE liver_function_log_entries');
        $this->addSql('DROP TABLE medical_notes_log_entries');
        $this->addSql('DROP TABLE record_log_entries');
        $this->addSql('DROP TABLE serum_electrolytes_log_entries');
        $this->addSql('DROP TABLE triage_log_entries');
        $this->addSql('DROP TABLE vital_signs_log_entries');
        $this->addSql('DROP INDEX UNIQ_9B349F9122A5C3AB');
        $this->addSql('ALTER TABLE record DROP covid_id');
    }
}
