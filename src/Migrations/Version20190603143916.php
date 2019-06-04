<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190603143916 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE departements (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE departements_user (departements_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_357A0F9A1DB279A6 (departements_id), INDEX IDX_357A0F9AA76ED395 (user_id), PRIMARY KEY(departements_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instruments (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, username VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, instrument VARCHAR(255) DEFAULT NULL, departement INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_instruments (user_id INT NOT NULL, instruments_id INT NOT NULL, INDEX IDX_4A4B179EA76ED395 (user_id), INDEX IDX_4A4B179E1EC49357 (instruments_id), PRIMARY KEY(user_id, instruments_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE departements_user ADD CONSTRAINT FK_357A0F9A1DB279A6 FOREIGN KEY (departements_id) REFERENCES departements (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE departements_user ADD CONSTRAINT FK_357A0F9AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_instruments ADD CONSTRAINT FK_4A4B179EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_instruments ADD CONSTRAINT FK_4A4B179E1EC49357 FOREIGN KEY (instruments_id) REFERENCES instruments (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE departements_user DROP FOREIGN KEY FK_357A0F9A1DB279A6');
        $this->addSql('ALTER TABLE user_instruments DROP FOREIGN KEY FK_4A4B179E1EC49357');
        $this->addSql('ALTER TABLE departements_user DROP FOREIGN KEY FK_357A0F9AA76ED395');
        $this->addSql('ALTER TABLE user_instruments DROP FOREIGN KEY FK_4A4B179EA76ED395');
        $this->addSql('DROP TABLE departements');
        $this->addSql('DROP TABLE departements_user');
        $this->addSql('DROP TABLE instruments');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_instruments');
    }
}
