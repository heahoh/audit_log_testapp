<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119211240 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE seller (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sku (id INT AUTO_INCREMENT NOT NULL, seller_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_F9038C4DF4C85EA (seller_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sku ADD CONSTRAINT FK_F9038C4DF4C85EA FOREIGN KEY (seller_id_id) REFERENCES seller (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE sku DROP FOREIGN KEY FK_F9038C4DF4C85EA');
        $this->addSql('DROP TABLE seller');
        $this->addSql('DROP TABLE sku');
    }
}
