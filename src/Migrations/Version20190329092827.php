<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190329092827 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, token VARCHAR(255) NOT NULL, username VARCHAR(100) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, name VARCHAR(100) DEFAULT NULL, surname VARCHAR(100) DEFAULT NULL, description LONGTEXT DEFAULT NULL, url_music VARCHAR(255) DEFAULT NULL, url_video VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_style (user_id INT NOT NULL, style_id INT NOT NULL, INDEX IDX_D17F4332A76ED395 (user_id), INDEX IDX_D17F4332BACD6074 (style_id), PRIMARY KEY(user_id, style_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description LONGTEXT NOT NULL, logo VARCHAR(255) DEFAULT NULL, url_video VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE groupe_user (groupe_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_257BA9FE7A45358C (groupe_id), INDEX IDX_257BA9FEA76ED395 (user_id), PRIMARY KEY(groupe_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE instrument (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, categorie VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE style (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, categoerie VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_instrument (id INT AUTO_INCREMENT NOT NULL, instrument_id INT NOT NULL, niveau VARCHAR(30) NOT NULL, INDEX IDX_9BD8AF31CF11D9C (instrument_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_style ADD CONSTRAINT FK_D17F4332A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_style ADD CONSTRAINT FK_D17F4332BACD6074 FOREIGN KEY (style_id) REFERENCES style (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_user ADD CONSTRAINT FK_257BA9FE7A45358C FOREIGN KEY (groupe_id) REFERENCES groupe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE groupe_user ADD CONSTRAINT FK_257BA9FEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_instrument ADD CONSTRAINT FK_9BD8AF31CF11D9C FOREIGN KEY (instrument_id) REFERENCES instrument (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_style DROP FOREIGN KEY FK_D17F4332A76ED395');
        $this->addSql('ALTER TABLE groupe_user DROP FOREIGN KEY FK_257BA9FEA76ED395');
        $this->addSql('ALTER TABLE groupe_user DROP FOREIGN KEY FK_257BA9FE7A45358C');
        $this->addSql('ALTER TABLE user_instrument DROP FOREIGN KEY FK_9BD8AF31CF11D9C');
        $this->addSql('ALTER TABLE user_style DROP FOREIGN KEY FK_D17F4332BACD6074');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_style');
        $this->addSql('DROP TABLE groupe');
        $this->addSql('DROP TABLE groupe_user');
        $this->addSql('DROP TABLE instrument');
        $this->addSql('DROP TABLE style');
        $this->addSql('DROP TABLE user_instrument');
    }
}
