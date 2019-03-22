<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
<<<<<<< HEAD:src/Migrations/Version20190322144716.php
final class Version20190322144716 extends AbstractMigration
=======
final class Version20190322114445 extends AbstractMigration
>>>>>>> 48e7372d0a8e0a9182ec473aafc99dd1daa6c98a:src/Migrations/Version20190322114445.php
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE instrument (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, categorie VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
<<<<<<< HEAD:src/Migrations/Version20190322144716.php
=======
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, categoerie VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
>>>>>>> 48e7372d0a8e0a9182ec473aafc99dd1daa6c98a:src/Migrations/Version20190322114445.php
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE instrument');
<<<<<<< HEAD:src/Migrations/Version20190322144716.php
=======
        $this->addSql('DROP TABLE style');
>>>>>>> 48e7372d0a8e0a9182ec473aafc99dd1daa6c98a:src/Migrations/Version20190322114445.php
        $this->addSql('DROP TABLE user');
    }
}
