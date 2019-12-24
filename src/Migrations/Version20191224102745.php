<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191224102745 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE archer_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, acronym VARCHAR(10) NOT NULL, minimum_age INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament (id INT AUTO_INCREMENT NOT NULL, organizer_id INT DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, type INT NOT NULL, INDEX IDX_BD5FB8D9876C4DDA (organizer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE peloton (id INT AUTO_INCREMENT NOT NULL, tournament_id INT DEFAULT NULL, max_participant INT NOT NULL, type INT NOT NULL, start_time DATETIME NOT NULL, INDEX IDX_D2D171E33D1A3E7 (tournament_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE league (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, acronym VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE affiliate (id INT AUTO_INCREMENT NOT NULL, club_id INT NOT NULL, archer_id INT NOT NULL, affiliate_number VARCHAR(15) NOT NULL, affiliate_since DATE NOT NULL, affiliate_end DATE DEFAULT NULL, INDEX IDX_597AA5CF61190A32 (club_id), INDEX IDX_597AA5CF147940E3 (archer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, archer_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(64) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649147940E3 (archer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, archer_id INT DEFAULT NULL, peloton_id INT DEFAULT NULL, category_id INT DEFAULT NULL, points INT NOT NULL, number_of_x INT DEFAULT NULL, number_of_ten INT NOT NULL, number_of_nine INT DEFAULT NULL, is_forfeited TINYINT(1) NOT NULL, INDEX IDX_D79F6B11147940E3 (archer_id), INDEX IDX_D79F6B1130A593A4 (peloton_id), INDEX IDX_D79F6B1112469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(255) NOT NULL, number INT DEFAULT NULL, locality VARCHAR(255) NOT NULL, postalcode INT NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE archer (id INT AUTO_INCREMENT NOT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, status INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, league_id INT NOT NULL, name VARCHAR(255) NOT NULL, number INT NOT NULL, INDEX IDX_F62F17658AFC4DE (league_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT FK_BD5FB8D9876C4DDA FOREIGN KEY (organizer_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE peloton ADD CONSTRAINT FK_D2D171E33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('ALTER TABLE affiliate ADD CONSTRAINT FK_597AA5CF61190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE affiliate ADD CONSTRAINT FK_597AA5CF147940E3 FOREIGN KEY (archer_id) REFERENCES archer (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649147940E3 FOREIGN KEY (archer_id) REFERENCES archer (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11147940E3 FOREIGN KEY (archer_id) REFERENCES archer (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B1130A593A4 FOREIGN KEY (peloton_id) REFERENCES peloton (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B1112469DE2 FOREIGN KEY (category_id) REFERENCES archer_category (id)');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F17658AFC4DE FOREIGN KEY (league_id) REFERENCES league (id)');
        $this->addSql('ALTER TABLE club ADD region_id INT NOT NULL');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE387298260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('CREATE INDEX IDX_B8EE387298260155 ON club (region_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B1112469DE2');
        $this->addSql('ALTER TABLE peloton DROP FOREIGN KEY FK_D2D171E33D1A3E7');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B1130A593A4');
        $this->addSql('ALTER TABLE region DROP FOREIGN KEY FK_F62F17658AFC4DE');
        $this->addSql('ALTER TABLE affiliate DROP FOREIGN KEY FK_597AA5CF147940E3');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649147940E3');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11147940E3');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE387298260155');
        $this->addSql('DROP TABLE archer_category');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('DROP TABLE peloton');
        $this->addSql('DROP TABLE league');
        $this->addSql('DROP TABLE affiliate');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE archer');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP INDEX IDX_B8EE387298260155 ON club');
        $this->addSql('ALTER TABLE club DROP region_id');
    }
}
