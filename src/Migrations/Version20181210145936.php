<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181210145936 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE candidate_customer (id INT AUTO_INCREMENT NOT NULL, candidate_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, affected_at DATETIME NOT NULL, rejected_at DATETIME DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_2067CCDA91BD8781 (candidate_id), INDEX IDX_2067CCDA9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, company_name VARCHAR(255) NOT NULL, company_description LONGTEXT DEFAULT NULL, manager_fullname VARCHAR(255) NOT NULL, manager_tel VARCHAR(255) DEFAULT NULL, manager_linkedin VARCHAR(255) DEFAULT NULL, manager_fb VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidate_customer ADD CONSTRAINT FK_2067CCDA91BD8781 FOREIGN KEY (candidate_id) REFERENCES candidate (id)');
        $this->addSql('ALTER TABLE candidate_customer ADD CONSTRAINT FK_2067CCDA9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE candidate ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, CHANGE in_post in_post TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE curriculum_vitae ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE candidate_customer DROP FOREIGN KEY FK_2067CCDA9395C3F3');
        $this->addSql('DROP TABLE candidate_customer');
        $this->addSql('DROP TABLE customer');
        $this->addSql('ALTER TABLE candidate DROP created_at, DROP updated_at, CHANGE in_post in_post TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE curriculum_vitae DROP created_at, DROP updated_at');
    }
}
