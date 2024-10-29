<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\User;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241029211652 extends AbstractMigration 
{

    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE blog_post (id SERIAL NOT NULL, author_id INT NOT NULL, title VARCHAR(255) NOT NULL, body TEXT NOT NULL, uploaded_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BA5AE01DF675F31B ON blog_post (author_id)');
        $this->addSql('CREATE TABLE chapter (id SERIAL NOT NULL, media_id INT DEFAULT NULL, web_serie_id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, number INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F981B52EEA9FDD75 ON chapter (media_id)');
        $this->addSql('CREATE INDEX IDX_F981B52ECE1C9950 ON chapter (web_serie_id)');
        $this->addSql('CREATE TABLE city (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, country VARCHAR(3) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE media (id SERIAL NOT NULL, size DOUBLE PRECISION NOT NULL, path VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, timestamp TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE node (id SERIAL NOT NULL, owner_id INT NOT NULL, city_id INT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, code VARCHAR(3) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, web VARCHAR(255) NOT NULL, banner VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_857FE8457E3C61F9 ON node (owner_id)');
        $this->addSql('CREATE INDEX IDX_857FE8458BAC62AF ON node (city_id)');
        $this->addSql('CREATE TABLE node_profile (node_id INT NOT NULL, profile_id INT NOT NULL, PRIMARY KEY(node_id, profile_id))');
        $this->addSql('CREATE INDEX IDX_275FEF7D460D9FD7 ON node_profile (node_id)');
        $this->addSql('CREATE INDEX IDX_275FEF7DCCFA12B8 ON node_profile (profile_id)');
        $this->addSql('CREATE TABLE profile (id SERIAL NOT NULL, account_id INT DEFAULT NULL, site_id INT NOT NULL, full_name VARCHAR(255) NOT NULL, avatar VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8157AA0F9B6B5FBA ON profile (account_id)');
        $this->addSql('CREATE INDEX IDX_8157AA0FF6BD1646 ON profile (site_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, media_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8D93D649EA9FDD75 ON "user" (media_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('CREATE TABLE web_serie (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, upload TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE webinar (id SERIAL NOT NULL, link VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, description TEXT NOT NULL, upload TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deadline TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, status BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE blog_post ADD CONSTRAINT FK_BA5AE01DF675F31B FOREIGN KEY (author_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chapter ADD CONSTRAINT FK_F981B52EEA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE chapter ADD CONSTRAINT FK_F981B52ECE1C9950 FOREIGN KEY (web_serie_id) REFERENCES web_serie (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE node ADD CONSTRAINT FK_857FE8457E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE node ADD CONSTRAINT FK_857FE8458BAC62AF FOREIGN KEY (city_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE node_profile ADD CONSTRAINT FK_275FEF7D460D9FD7 FOREIGN KEY (node_id) REFERENCES node (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE node_profile ADD CONSTRAINT FK_275FEF7DCCFA12B8 FOREIGN KEY (profile_id) REFERENCES profile (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0F9B6B5FBA FOREIGN KEY (account_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE profile ADD CONSTRAINT FK_8157AA0FF6BD1646 FOREIGN KEY (site_id) REFERENCES city (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function postUp(Schema $schema): void
    {
        // $this->connection->insert("user", [
        //     "email" => "admin@proplayas.org",
        //     "password" => password_hash("admin", PASSWORD_BCRYPT),
        //     "roles" => json_encode([
        //         "ROLE_SUPERADMIN"
        //     ])
        // ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blog_post DROP CONSTRAINT FK_BA5AE01DF675F31B');
        $this->addSql('ALTER TABLE chapter DROP CONSTRAINT FK_F981B52EEA9FDD75');
        $this->addSql('ALTER TABLE chapter DROP CONSTRAINT FK_F981B52ECE1C9950');
        $this->addSql('ALTER TABLE node DROP CONSTRAINT FK_857FE8457E3C61F9');
        $this->addSql('ALTER TABLE node DROP CONSTRAINT FK_857FE8458BAC62AF');
        $this->addSql('ALTER TABLE node_profile DROP CONSTRAINT FK_275FEF7D460D9FD7');
        $this->addSql('ALTER TABLE node_profile DROP CONSTRAINT FK_275FEF7DCCFA12B8');
        $this->addSql('ALTER TABLE profile DROP CONSTRAINT FK_8157AA0F9B6B5FBA');
        $this->addSql('ALTER TABLE profile DROP CONSTRAINT FK_8157AA0FF6BD1646');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649EA9FDD75');
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('DROP TABLE chapter');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE node');
        $this->addSql('DROP TABLE node_profile');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE web_serie');
        $this->addSql('DROP TABLE webinar');
    }
}
