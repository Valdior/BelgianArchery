<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200405094848 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tournament_attachment (tournament_id INT NOT NULL, attachment_id INT NOT NULL, INDEX IDX_133F79E133D1A3E7 (tournament_id), INDEX IDX_133F79E1464E68B (attachment_id), PRIMARY KEY(tournament_id, attachment_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tournament_attachment ADD CONSTRAINT FK_133F79E133D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tournament_attachment ADD CONSTRAINT FK_133F79E1464E68B FOREIGN KEY (attachment_id) REFERENCES attachment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tournament DROP FOREIGN KEY FK_BD5FB8D9464E68B');
        $this->addSql('DROP INDEX IDX_BD5FB8D9464E68B ON tournament');
        $this->addSql('ALTER TABLE tournament DROP attachment_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tournament_attachment');
        $this->addSql('ALTER TABLE tournament ADD attachment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT FK_BD5FB8D9464E68B FOREIGN KEY (attachment_id) REFERENCES attachment (id)');
        $this->addSql('CREATE INDEX IDX_BD5FB8D9464E68B ON tournament (attachment_id)');
    }
}
