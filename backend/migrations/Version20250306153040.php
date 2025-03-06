<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250306153040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE coffee_order_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE coffee_order (id INT NOT NULL, coffee_id INT NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9BE3854A78CD6D6E ON coffee_order (coffee_id)');
        $this->addSql('ALTER TABLE coffee_order ADD CONSTRAINT FK_9BE3854A78CD6D6E FOREIGN KEY (coffee_id) REFERENCES coffee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE coffee_order_id_seq CASCADE');
        $this->addSql('ALTER TABLE coffee_order DROP CONSTRAINT FK_9BE3854A78CD6D6E');
        $this->addSql('DROP TABLE coffee_order');
    }
}
