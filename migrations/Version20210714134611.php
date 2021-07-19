<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210714134611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, title LONGTEXT NOT NULL, url LONGTEXT NOT NULL, image_url LONGTEXT NOT NULL, number_in_stock INT NOT NULL, price NUMERIC(5, 2) NOT NULL, selling_points LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', short_description LONGTEXT DEFAULT NULL, long_description LONGTEXT DEFAULT NULL, in_store TINYINT(1) NOT NULL, contents LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', more_information LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', usage_rate LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', features LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE product');
    }
}
