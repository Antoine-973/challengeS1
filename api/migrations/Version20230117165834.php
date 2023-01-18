<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230117165834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE greeting_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE agenda_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE animal_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE behaviour_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE breed_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE donation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "like_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE review_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE spa_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE species_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE agenda (id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE animal (id INT NOT NULL, name VARCHAR(255) NOT NULL, age VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, birth_location VARCHAR(255) NOT NULL, description TEXT NOT NULL, picture VARCHAR(255) NOT NULL, is_sterilize BOOLEAN NOT NULL, disease VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE behaviour (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE breed (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE donation (id INT NOT NULL, amount DOUBLE PRECISION NOT NULL, order_id INT NOT NULL, is_subscriber BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "like" (id INT NOT NULL, user_id INT NOT NULL, animal_id INT NOT NULL, is_pending BOOLEAN NOT NULL, is_validate BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE review (id INT NOT NULL, rate INT NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE spa (id INT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, description TEXT NOT NULL, email VARCHAR(255) NOT NULL, phone_number VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE species (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, spa_id_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, username VARCHAR(30) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, picture VARCHAR(255) DEFAULT NULL, is_subscriber BOOLEAN NOT NULL, confirm_account VARCHAR(255) DEFAULT NULL, is_verified BOOLEAN NOT NULL, reset_password VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE INDEX IDX_8D93D649EA08EE17 ON "user" (spa_id_id)');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649EA08EE17 FOREIGN KEY (spa_id_id) REFERENCES spa (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE greeting');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE agenda_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE animal_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE behaviour_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE breed_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE donation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "like_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE review_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE spa_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE species_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('CREATE SEQUENCE greeting_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE greeting (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649EA08EE17');
        $this->addSql('DROP TABLE agenda');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE behaviour');
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP TABLE donation');
        $this->addSql('DROP TABLE "like"');
        $this->addSql('DROP TABLE review');
        $this->addSql('DROP TABLE spa');
        $this->addSql('DROP TABLE species');
        $this->addSql('DROP TABLE "user"');
    }
}
