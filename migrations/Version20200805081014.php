<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200805081014 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE _user (id INT AUTO_INCREMENT NOT NULL, archer_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', token_password VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) NOT NULL, token_registration VARCHAR(255) DEFAULT NULL, created_on DATETIME NOT NULL, modified_on DATETIME DEFAULT NULL, token_validate_on DATETIME DEFAULT NULL, token_password_validate_on DATETIME DEFAULT NULL, last_login_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_D0B6A652E7927C74 (email), UNIQUE INDEX UNIQ_D0B6A652F85E0677 (username), UNIQUE INDEX UNIQ_D0B6A652147940E3 (archer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE affiliate (id INT AUTO_INCREMENT NOT NULL, club_id INT NOT NULL, archer_id INT NOT NULL, affiliate_number VARCHAR(15) NOT NULL, affiliate_since DATE NOT NULL, affiliate_end DATE DEFAULT NULL, INDEX IDX_597AA5CF61190A32 (club_id), INDEX IDX_597AA5CF147940E3 (archer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE archer (id INT AUTO_INCREMENT NOT NULL, default_category_id INT DEFAULT NULL, lastname VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, birthdate DATE DEFAULT NULL, status INT NOT NULL, gender INT DEFAULT NULL, default_arc INT DEFAULT NULL, INDEX IDX_38AE8374C6B58E54 (default_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE archer_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, acronym VARCHAR(10) NOT NULL, minimum_age INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attachment (id INT AUTO_INCREMENT NOT NULL, attachment_name VARCHAR(255) DEFAULT NULL, attachment_size INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_post (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, body LONGTEXT DEFAULT NULL, created_on DATETIME NOT NULL, modified_on DATETIME DEFAULT NULL, is_published TINYINT(1) NOT NULL, published_on DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_BA5AE01D989D9B62 (slug), INDEX IDX_BA5AE01DF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE club (id INT AUTO_INCREMENT NOT NULL, region_id INT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, number INT NOT NULL, acronym VARCHAR(10) NOT NULL, email VARCHAR(255) NOT NULL, website VARCHAR(255) DEFAULT NULL, INDEX IDX_B8EE387298260155 (region_id), UNIQUE INDEX UNIQ_B8EE38727E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE league (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, acronym VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(255) NOT NULL, number INT DEFAULT NULL, locality VARCHAR(255) NOT NULL, postalcode INT NOT NULL, city VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participant (id INT AUTO_INCREMENT NOT NULL, archer_id INT DEFAULT NULL, peloton_id INT DEFAULT NULL, category_id INT DEFAULT NULL, points INT NOT NULL, number_of_x INT DEFAULT NULL, number_of_ten INT NOT NULL, number_of_nine INT DEFAULT NULL, is_forfeited TINYINT(1) NOT NULL, INDEX IDX_D79F6B11147940E3 (archer_id), INDEX IDX_D79F6B1130A593A4 (peloton_id), INDEX IDX_D79F6B1112469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE peloton (id INT AUTO_INCREMENT NOT NULL, tournament_id INT DEFAULT NULL, max_participant INT NOT NULL, type INT NOT NULL, start_time DATETIME NOT NULL, INDEX IDX_D2D171E33D1A3E7 (tournament_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, league_id INT NOT NULL, name VARCHAR(255) NOT NULL, number INT NOT NULL, INDEX IDX_F62F17658AFC4DE (league_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament (id INT AUTO_INCREMENT NOT NULL, organizer_id INT DEFAULT NULL, location_id INT NOT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, type INT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, contact VARCHAR(255) NOT NULL, information LONGTEXT DEFAULT NULL, INDEX IDX_BD5FB8D9876C4DDA (organizer_id), INDEX IDX_BD5FB8D964D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournament_search (id INT AUTO_INCREMENT NOT NULL, type INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE _user ADD CONSTRAINT FK_D0B6A652147940E3 FOREIGN KEY (archer_id) REFERENCES archer (id)');
        $this->addSql('ALTER TABLE affiliate ADD CONSTRAINT FK_597AA5CF61190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE affiliate ADD CONSTRAINT FK_597AA5CF147940E3 FOREIGN KEY (archer_id) REFERENCES archer (id)');
        $this->addSql('ALTER TABLE archer ADD CONSTRAINT FK_38AE8374C6B58E54 FOREIGN KEY (default_category_id) REFERENCES archer_category (id)');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01DF675F31B FOREIGN KEY (author_id) REFERENCES _user (id)');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE387298260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE club ADD CONSTRAINT FK_B8EE38727E3C61F9 FOREIGN KEY (owner_id) REFERENCES archer (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B11147940E3 FOREIGN KEY (archer_id) REFERENCES archer (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B1130A593A4 FOREIGN KEY (peloton_id) REFERENCES peloton (id)');
        $this->addSql('ALTER TABLE participant ADD CONSTRAINT FK_D79F6B1112469DE2 FOREIGN KEY (category_id) REFERENCES archer_category (id)');
        $this->addSql('ALTER TABLE peloton ADD CONSTRAINT FK_D2D171E33D1A3E7 FOREIGN KEY (tournament_id) REFERENCES tournament (id)');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F17658AFC4DE FOREIGN KEY (league_id) REFERENCES league (id)');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES _user (id)');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT FK_BD5FB8D9876C4DDA FOREIGN KEY (organizer_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE tournament ADD CONSTRAINT FK_BD5FB8D964D218E FOREIGN KEY (location_id) REFERENCES location (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_post DROP FOREIGN KEY FK_BA5AE01DF675F31B');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE _user DROP FOREIGN KEY FK_D0B6A652147940E3');
        $this->addSql('ALTER TABLE affiliate DROP FOREIGN KEY FK_597AA5CF147940E3');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE38727E3C61F9');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B11147940E3');
        $this->addSql('ALTER TABLE archer DROP FOREIGN KEY FK_38AE8374C6B58E54');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B1112469DE2');
        $this->addSql('ALTER TABLE affiliate DROP FOREIGN KEY FK_597AA5CF61190A32');
        $this->addSql('ALTER TABLE tournament DROP FOREIGN KEY FK_BD5FB8D9876C4DDA');
        $this->addSql('ALTER TABLE region DROP FOREIGN KEY FK_F62F17658AFC4DE');
        $this->addSql('ALTER TABLE tournament DROP FOREIGN KEY FK_BD5FB8D964D218E');
        $this->addSql('ALTER TABLE participant DROP FOREIGN KEY FK_D79F6B1130A593A4');
        $this->addSql('ALTER TABLE club DROP FOREIGN KEY FK_B8EE387298260155');
        $this->addSql('ALTER TABLE peloton DROP FOREIGN KEY FK_D2D171E33D1A3E7');
        $this->addSql('DROP TABLE _user');
        $this->addSql('DROP TABLE affiliate');
        $this->addSql('DROP TABLE archer');
        $this->addSql('DROP TABLE archer_category');
        $this->addSql('DROP TABLE attachment');
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('DROP TABLE club');
        $this->addSql('DROP TABLE league');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE participant');
        $this->addSql('DROP TABLE peloton');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE tournament');
        $this->addSql('DROP TABLE tournament_search');
    }
}
