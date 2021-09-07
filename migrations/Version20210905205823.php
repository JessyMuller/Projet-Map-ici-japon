<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210905205823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name_category VARCHAR(255) NOT NULL, logo_category VARCHAR(255) NOT NULL, description_category LONGTEXT NOT NULL, image_category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE marker ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE marker ADD CONSTRAINT FK_82CF20FE12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_82CF20FE12469DE2 ON marker (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE marker DROP FOREIGN KEY FK_82CF20FE12469DE2');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP INDEX IDX_82CF20FE12469DE2 ON marker');
        $this->addSql('ALTER TABLE marker DROP category_id');
    }
}
