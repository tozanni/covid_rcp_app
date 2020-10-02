<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201002053706 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Update record table with created_by and updated_by columns';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE record ADD created_by UUID DEFAULT NULL');
        $this->addSql('ALTER TABLE record ADD updated_by UUID DEFAULT NULL');
        $this->addSql('COMMENT ON COLUMN record.created_by IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN record.updated_by IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F91DE12AB56 FOREIGN KEY (created_by) REFERENCES fos_user_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F9116FE72E1 FOREIGN KEY (updated_by) REFERENCES fos_user_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9B349F91DE12AB56 ON record (created_by)');
        $this->addSql('CREATE INDEX IDX_9B349F9116FE72E1 ON record (updated_by)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE record DROP CONSTRAINT FK_9B349F91DE12AB56');
        $this->addSql('ALTER TABLE record DROP CONSTRAINT FK_9B349F9116FE72E1');
        $this->addSql('DROP INDEX IDX_9B349F91DE12AB56');
        $this->addSql('DROP INDEX IDX_9B349F9116FE72E1');
        $this->addSql('ALTER TABLE record DROP created_by');
        $this->addSql('ALTER TABLE record DROP updated_by');
    }
}
