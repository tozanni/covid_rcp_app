<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200716234523 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Initial schema creation with users and groups tables';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ext_log_entries_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE blood_chemistry (id UUID NOT NULL, glucose DOUBLE PRECISION DEFAULT NULL, urea DOUBLE PRECISION DEFAULT NULL, creatinine DOUBLE PRECISION DEFAULT NULL, cholesterol DOUBLE PRECISION DEFAULT NULL, triglycerides DOUBLE PRECISION DEFAULT NULL, glycated_hemoglobin DOUBLE PRECISION DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN blood_chemistry.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN blood_chemistry.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN blood_chemistry.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE clotting_time (id UUID NOT NULL, prothrombin DOUBLE PRECISION DEFAULT NULL, thromboplastin DOUBLE PRECISION DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN clotting_time.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN clotting_time.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN clotting_time.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE ext_log_entries (id INT NOT NULL, action VARCHAR(8) NOT NULL, logged_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, object_id VARCHAR(64) DEFAULT NULL, object_class VARCHAR(255) NOT NULL, version INT NOT NULL, data TEXT DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX log_class_lookup_idx ON ext_log_entries (object_class)');
        $this->addSql('CREATE INDEX log_date_lookup_idx ON ext_log_entries (logged_at)');
        $this->addSql('CREATE INDEX log_user_lookup_idx ON ext_log_entries (username)');
        $this->addSql('CREATE INDEX log_version_lookup_idx ON ext_log_entries (object_id, object_class, version)');
        $this->addSql('COMMENT ON COLUMN ext_log_entries.data IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE fos_user_group (id UUID NOT NULL, name VARCHAR(180) NOT NULL, roles TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_583D1F3E5E237E06 ON fos_user_group (name)');
        $this->addSql('COMMENT ON COLUMN fos_user_group.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN fos_user_group.roles IS \'(DC2Type:array)\'');
        $this->addSql('CREATE TABLE fos_user_user (id UUID NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled BOOLEAN NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, roles TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_of_birth TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, firstname VARCHAR(64) DEFAULT NULL, lastname VARCHAR(64) DEFAULT NULL, website VARCHAR(64) DEFAULT NULL, biography VARCHAR(1000) DEFAULT NULL, gender VARCHAR(1) DEFAULT NULL, locale VARCHAR(8) DEFAULT NULL, timezone VARCHAR(64) DEFAULT NULL, phone VARCHAR(64) DEFAULT NULL, facebook_uid VARCHAR(255) DEFAULT NULL, facebook_name VARCHAR(255) DEFAULT NULL, facebook_data TEXT DEFAULT NULL, twitter_uid VARCHAR(255) DEFAULT NULL, twitter_name VARCHAR(255) DEFAULT NULL, twitter_data TEXT DEFAULT NULL, gplus_uid VARCHAR(255) DEFAULT NULL, gplus_name VARCHAR(255) DEFAULT NULL, gplus_data TEXT DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, two_step_code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C560D76192FC23A8 ON fos_user_user (username_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C560D761A0D96FBF ON fos_user_user (email_canonical)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C560D761C05FB297 ON fos_user_user (confirmation_token)');
        $this->addSql('COMMENT ON COLUMN fos_user_user.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN fos_user_user.roles IS \'(DC2Type:array)\'');
        $this->addSql('COMMENT ON COLUMN fos_user_user.facebook_data IS \'(DC2Type:json)\'');
        $this->addSql('COMMENT ON COLUMN fos_user_user.twitter_data IS \'(DC2Type:json)\'');
        $this->addSql('COMMENT ON COLUMN fos_user_user.gplus_data IS \'(DC2Type:json)\'');
        $this->addSql('CREATE TABLE fos_user_user_group (user_id UUID NOT NULL, group_id UUID NOT NULL, PRIMARY KEY(user_id, group_id))');
        $this->addSql('CREATE INDEX IDX_B3C77447A76ED395 ON fos_user_user_group (user_id)');
        $this->addSql('CREATE INDEX IDX_B3C77447FE54D947 ON fos_user_user_group (group_id)');
        $this->addSql('COMMENT ON COLUMN fos_user_user_group.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN fos_user_user_group.group_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE hematic_biometry (id UUID NOT NULL, hematocrit DOUBLE PRECISION DEFAULT NULL, hemoglobin DOUBLE PRECISION DEFAULT NULL, leukocytes DOUBLE PRECISION DEFAULT NULL, platelets DOUBLE PRECISION DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN hematic_biometry.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN hematic_biometry.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN hematic_biometry.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE imaging (id UUID NOT NULL, radiography BOOLEAN DEFAULT NULL, result VARCHAR(128) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN imaging.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN imaging.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN imaging.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE immunological (id UUID NOT NULL, reactive_protein_c DOUBLE PRECISION DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN immunological.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN immunological.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN immunological.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE liver_function (id UUID NOT NULL, aspartate_aminotransferase DOUBLE PRECISION DEFAULT NULL, alanine_transaminase DOUBLE PRECISION DEFAULT NULL, blood_urea_nitrogen DOUBLE PRECISION DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN liver_function.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN liver_function.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN liver_function.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE medical_notes (id UUID NOT NULL, notes TEXT NOT NULL, prescription_drugs TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN medical_notes.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN medical_notes.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN medical_notes.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE record (id UUID NOT NULL, vital_signs_id UUID DEFAULT NULL, triage_id UUID DEFAULT NULL, hematic_biometry_id UUID DEFAULT NULL, blood_chemistry_id UUID DEFAULT NULL, serum_electrolytes_id UUID DEFAULT NULL, medical_notes_id UUID DEFAULT NULL, liver_function_id UUID DEFAULT NULL, clotting_time_id UUID DEFAULT NULL, immunological_id UUID DEFAULT NULL, imaging_id UUID DEFAULT NULL, admission_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, id_canonical VARCHAR(255) DEFAULT NULL, status VARCHAR(128) NOT NULL, egress_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, egress_type VARCHAR(32) DEFAULT NULL, rcp_required BOOLEAN DEFAULT NULL, treatment TEXT DEFAULT NULL, egress_notes TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B349F9175DEB273 ON record (vital_signs_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B349F91C65F751D ON record (triage_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B349F91B67D2472 ON record (hematic_biometry_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B349F91D8E4C35C ON record (blood_chemistry_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B349F916B1A984B ON record (serum_electrolytes_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B349F9180CC1801 ON record (medical_notes_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B349F917F3497FE ON record (liver_function_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B349F91EF849A5D ON record (clotting_time_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B349F9166C16F61 ON record (immunological_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B349F9170CB757 ON record (imaging_id)');
        $this->addSql('COMMENT ON COLUMN record.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN record.vital_signs_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN record.triage_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN record.hematic_biometry_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN record.blood_chemistry_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN record.serum_electrolytes_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN record.medical_notes_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN record.liver_function_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN record.clotting_time_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN record.immunological_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN record.imaging_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE serum_electrolytes (id UUID NOT NULL, sodium DOUBLE PRECISION DEFAULT NULL, potassium DOUBLE PRECISION DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN serum_electrolytes.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN serum_electrolytes.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN serum_electrolytes.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE triage (id UUID NOT NULL, days_before_admission INT NOT NULL, difficulty_breathing BOOLEAN NOT NULL, chest_pain BOOLEAN NOT NULL, headache INT NOT NULL, cough INT NOT NULL, other_symptoms TEXT DEFAULT NULL, comorbidities TEXT DEFAULT NULL, smoker BOOLEAN DEFAULT NULL, pregnant BOOLEAN DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN triage.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN triage.other_symptoms IS \'(DC2Type:json)\'');
        $this->addSql('COMMENT ON COLUMN triage.comorbidities IS \'(DC2Type:json)\'');
        $this->addSql('COMMENT ON COLUMN triage.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN triage.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE vital_signs (id UUID NOT NULL, age DATE NOT NULL, gender VARCHAR(12) NOT NULL, weight DOUBLE PRECISION NOT NULL, height DOUBLE PRECISION NOT NULL, diastolic_blood_pressure DOUBLE PRECISION NOT NULL, systolic_blood_pressure DOUBLE PRECISION NOT NULL, heart_rate DOUBLE PRECISION NOT NULL, breathing_frequency DOUBLE PRECISION NOT NULL, temperature DOUBLE PRECISION NOT NULL, oximetry DOUBLE PRECISION NOT NULL, capillary_glucose DOUBLE PRECISION NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN vital_signs.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN vital_signs.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN vital_signs.updated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user_user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447FE54D947 FOREIGN KEY (group_id) REFERENCES fos_user_group (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F9175DEB273 FOREIGN KEY (vital_signs_id) REFERENCES vital_signs (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F91C65F751D FOREIGN KEY (triage_id) REFERENCES triage (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F91B67D2472 FOREIGN KEY (hematic_biometry_id) REFERENCES hematic_biometry (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F91D8E4C35C FOREIGN KEY (blood_chemistry_id) REFERENCES blood_chemistry (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F916B1A984B FOREIGN KEY (serum_electrolytes_id) REFERENCES serum_electrolytes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F9180CC1801 FOREIGN KEY (medical_notes_id) REFERENCES medical_notes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F917F3497FE FOREIGN KEY (liver_function_id) REFERENCES liver_function (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F91EF849A5D FOREIGN KEY (clotting_time_id) REFERENCES clotting_time (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F9166C16F61 FOREIGN KEY (immunological_id) REFERENCES immunological (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F9170CB757 FOREIGN KEY (imaging_id) REFERENCES imaging (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE record DROP CONSTRAINT FK_9B349F91D8E4C35C');
        $this->addSql('ALTER TABLE record DROP CONSTRAINT FK_9B349F91EF849A5D');
        $this->addSql('ALTER TABLE fos_user_user_group DROP CONSTRAINT FK_B3C77447FE54D947');
        $this->addSql('ALTER TABLE fos_user_user_group DROP CONSTRAINT FK_B3C77447A76ED395');
        $this->addSql('ALTER TABLE record DROP CONSTRAINT FK_9B349F91B67D2472');
        $this->addSql('ALTER TABLE record DROP CONSTRAINT FK_9B349F9170CB757');
        $this->addSql('ALTER TABLE record DROP CONSTRAINT FK_9B349F9166C16F61');
        $this->addSql('ALTER TABLE record DROP CONSTRAINT FK_9B349F917F3497FE');
        $this->addSql('ALTER TABLE record DROP CONSTRAINT FK_9B349F9180CC1801');
        $this->addSql('ALTER TABLE record DROP CONSTRAINT FK_9B349F916B1A984B');
        $this->addSql('ALTER TABLE record DROP CONSTRAINT FK_9B349F91C65F751D');
        $this->addSql('ALTER TABLE record DROP CONSTRAINT FK_9B349F9175DEB273');
        $this->addSql('DROP SEQUENCE ext_log_entries_id_seq CASCADE');
        $this->addSql('DROP TABLE blood_chemistry');
        $this->addSql('DROP TABLE clotting_time');
        $this->addSql('DROP TABLE ext_log_entries');
        $this->addSql('DROP TABLE fos_user_group');
        $this->addSql('DROP TABLE fos_user_user');
        $this->addSql('DROP TABLE fos_user_user_group');
        $this->addSql('DROP TABLE hematic_biometry');
        $this->addSql('DROP TABLE imaging');
        $this->addSql('DROP TABLE immunological');
        $this->addSql('DROP TABLE liver_function');
        $this->addSql('DROP TABLE medical_notes');
        $this->addSql('DROP TABLE record');
        $this->addSql('DROP TABLE serum_electrolytes');
        $this->addSql('DROP TABLE triage');
        $this->addSql('DROP TABLE vital_signs');
    }
}
