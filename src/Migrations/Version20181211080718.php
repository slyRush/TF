<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181211080718 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE candidate ADD cv_id INT DEFAULT NULL, CHANGE in_post in_post TINYINT(1) DEFAULT \'0\'');
        $this->addSql('ALTER TABLE candidate ADD CONSTRAINT FK_C8B28E44CFE419E2 FOREIGN KEY (cv_id) REFERENCES curriculum_vitae (id)');
        $this->addSql('CREATE INDEX IDX_C8B28E44CFE419E2 ON candidate (cv_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE candidate DROP FOREIGN KEY FK_C8B28E44CFE419E2');
        $this->addSql('DROP INDEX IDX_C8B28E44CFE419E2 ON candidate');
        $this->addSql('ALTER TABLE candidate DROP cv_id, CHANGE in_post in_post TINYINT(1) DEFAULT \'0\'');
    }
}
