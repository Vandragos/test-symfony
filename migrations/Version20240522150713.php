<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240522150713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prix NUMERIC(5, 2) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE boutique (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnel (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, boutique_id INT NOT NULL, UNIQUE INDEX UNIQ_A6BCF3DEFB88E14F (utilisateur_id), INDEX IDX_A6BCF3DEAB677BE6 (boutique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, article_id INT NOT NULL, boutique_id INT NOT NULL, tarif_location_jour NUMERIC(5, 2) NOT NULL, stock INT NOT NULL, INDEX IDX_4B3656607294869C (article_id), INDEX IDX_4B365660AB677BE6 (boutique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, login VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE personnel ADD CONSTRAINT FK_A6BCF3DEAB677BE6 FOREIGN KEY (boutique_id) REFERENCES boutique (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656607294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660AB677BE6 FOREIGN KEY (boutique_id) REFERENCES boutique (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEFB88E14F');
        $this->addSql('ALTER TABLE personnel DROP FOREIGN KEY FK_A6BCF3DEAB677BE6');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656607294869C');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660AB677BE6');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE boutique');
        $this->addSql('DROP TABLE personnel');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE utilisateur');
    }
}
