<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260817150052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clicks (id INT AUTO_INCREMENT NOT NULL, clicked_at DATETIME NOT NULL, user_agent VARCHAR(512) DEFAULT NULL, link_id INT NOT NULL, INDEX IDX_20DA1901ADA40271 (link_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE links (id INT AUTO_INCREMENT NOT NULL, original_url VARCHAR(2048) NOT NULL, short_code VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL, expires_at DATETIME DEFAULT NULL, owner_id INT NOT NULL, INDEX IDX_D182A1187E3C61F9 (owner_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750 (queue_name, available_at, delivered_at, id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE clicks ADD CONSTRAINT FK_20DA1901ADA40271 FOREIGN KEY (link_id) REFERENCES links (id)');
        $this->addSql('ALTER TABLE links ADD CONSTRAINT FK_D182A1187E3C61F9 FOREIGN KEY (owner_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE clicks DROP FOREIGN KEY FK_20DA1901ADA40271');
        $this->addSql('ALTER TABLE links DROP FOREIGN KEY FK_D182A1187E3C61F9');
        $this->addSql('DROP TABLE clicks');
        $this->addSql('DROP TABLE links');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
