<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250306151748 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE coffee_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE coffee (id INT NOT NULL, type_id INT NOT NULL, intensity_id INT NOT NULL, size_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_538529B3C54C8C93 ON coffee (type_id)');
        $this->addSql('CREATE INDEX IDX_538529B391A55F57 ON coffee (intensity_id)');
        $this->addSql('CREATE INDEX IDX_538529B3498DA827 ON coffee (size_id)');
        $this->addSql('ALTER TABLE coffee ADD CONSTRAINT FK_538529B3C54C8C93 FOREIGN KEY (type_id) REFERENCES coffee_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE coffee ADD CONSTRAINT FK_538529B391A55F57 FOREIGN KEY (intensity_id) REFERENCES coffee_intensity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE coffee ADD CONSTRAINT FK_538529B3498DA827 FOREIGN KEY (size_id) REFERENCES coffee_size (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE coffee_id_seq CASCADE');
        $this->addSql('ALTER TABLE coffee DROP CONSTRAINT FK_538529B3C54C8C93');
        $this->addSql('ALTER TABLE coffee DROP CONSTRAINT FK_538529B391A55F57');
        $this->addSql('ALTER TABLE coffee DROP CONSTRAINT FK_538529B3498DA827');
        $this->addSql('DROP TABLE coffee');
    }
}
