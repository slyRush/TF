<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181212062840 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE campaign ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE campaign_candidate ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE candidate ADD deleted_at DATETIME DEFAULT NULL, CHANGE in_post in_post TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE candidate_customer ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE curriculum_vitae ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE customer ADD deleted_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE level ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, ADD deleted_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE campaign DROP created_at, DROP updated_at, DROP deleted_at');
        $this->addSql('ALTER TABLE campaign_candidate DROP created_at, DROP updated_at, DROP deleted_at');
        $this->addSql('ALTER TABLE candidate DROP deleted_at, CHANGE in_post in_post TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE candidate_customer DROP deleted_at');
        $this->addSql('ALTER TABLE curriculum_vitae DROP deleted_at');
        $this->addSql('ALTER TABLE customer DROP deleted_at');
        $this->addSql('ALTER TABLE level DROP created_at, DROP updated_at, DROP deleted_at');
    }
}
