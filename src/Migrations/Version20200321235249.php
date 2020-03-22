<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200321235249 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE number_list MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE number_list CHANGE id id INT NOT NULL, CHANGE number number VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE number_list ADD PRIMARY KEY (number)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE number_list MODIFY number VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE number_list DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE number_list CHANGE number number VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE number_list ADD PRIMARY KEY (id)');
    }
}
