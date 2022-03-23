<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220323112304 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE repository_entity ADD repository VARCHAR(255) NOT NULL, ADD version VARCHAR(255) NOT NULL, ADD created DATETIME NOT NULL, ADD last_scan DATETIME NOT NULL, ADD scan_count INT NOT NULL, CHANGE url owner VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE trait_entity ADD created DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE messenger_messages CHANGE body body LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE headers headers LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE queue_name queue_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE repository_entity ADD url VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP owner, DROP repository, DROP version, DROP created, DROP last_scan, DROP scan_count');
        $this->addSql('ALTER TABLE trait_entity DROP created, CHANGE code code LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
