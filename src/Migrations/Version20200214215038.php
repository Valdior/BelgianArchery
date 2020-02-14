<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200214215038 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE archer ADD default_category_id INT DEFAULT NULL, ADD default_arc INT DEFAULT NULL');
        $this->addSql('ALTER TABLE archer ADD CONSTRAINT FK_38AE8374C6B58E54 FOREIGN KEY (default_category_id) REFERENCES archer_category (id)');
        $this->addSql('CREATE INDEX IDX_38AE8374C6B58E54 ON archer (default_category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE archer DROP FOREIGN KEY FK_38AE8374C6B58E54');
        $this->addSql('DROP INDEX IDX_38AE8374C6B58E54 ON archer');
        $this->addSql('ALTER TABLE archer DROP default_category_id, DROP default_arc');
    }
}
