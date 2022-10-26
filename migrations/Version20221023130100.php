<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221023130100 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(2) NOT NULL, latitude NUMERIC(10, 8) NOT NULL, longitude NUMERIC(10, 8) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE measurement (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, date DATE NOT NULL, celsius NUMERIC(3, 0) NOT NULL, INDEX IDX_2CE0D81164D218E (location_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE measurement ADD CONSTRAINT FK_2CE0D81164D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE lokalizacja DROP FOREIGN KEY FK_6FF1E22314EC5F75');
        $this->addSql('DROP TABLE dane_meteorologiczne');
        $this->addSql('DROP TABLE lokalizacja');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dane_meteorologiczne (id INT AUTO_INCREMENT NOT NULL, temperatura DOUBLE PRECISION NOT NULL, zachmurzenie DOUBLE PRECISION NOT NULL, wilgotnosc DOUBLE PRECISION NOT NULL, cisnienie_atmosferyczne DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE lokalizacja (id INT AUTO_INCREMENT NOT NULL, dane_meteorologiczne_id INT NOT NULL, miasto VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, kraj VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, INDEX IDX_6FF1E22314EC5F75 (dane_meteorologiczne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE lokalizacja ADD CONSTRAINT FK_6FF1E22314EC5F75 FOREIGN KEY (dane_meteorologiczne_id) REFERENCES dane_meteorologiczne (id)');
        $this->addSql('ALTER TABLE measurement DROP FOREIGN KEY FK_2CE0D81164D218E');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE measurement');
    }
}
