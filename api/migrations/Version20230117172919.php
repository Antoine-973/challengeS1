<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230117172919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE behaviour_animal (behaviour_id INT NOT NULL, animal_id INT NOT NULL, PRIMARY KEY(behaviour_id, animal_id))');
        $this->addSql('CREATE INDEX IDX_D5B552DCF3A0E8C5 ON behaviour_animal (behaviour_id)');
        $this->addSql('CREATE INDEX IDX_D5B552DC8E962C16 ON behaviour_animal (animal_id)');
        $this->addSql('ALTER TABLE behaviour_animal ADD CONSTRAINT FK_D5B552DCF3A0E8C5 FOREIGN KEY (behaviour_id) REFERENCES behaviour (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE behaviour_animal ADD CONSTRAINT FK_D5B552DC8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agenda ADD spa_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agenda ADD user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agenda ADD spa_user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE agenda ADD CONSTRAINT FK_2CEDC877EA08EE17 FOREIGN KEY (spa_id_id) REFERENCES spa (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agenda ADD CONSTRAINT FK_2CEDC8779D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE agenda ADD CONSTRAINT FK_2CEDC877DBFC9721 FOREIGN KEY (spa_user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2CEDC877EA08EE17 ON agenda (spa_id_id)');
        $this->addSql('CREATE INDEX IDX_2CEDC8779D86650F ON agenda (user_id_id)');
        $this->addSql('CREATE INDEX IDX_2CEDC877DBFC9721 ON agenda (spa_user_id_id)');
        $this->addSql('ALTER TABLE animal ADD species_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FC6A6D2CB FOREIGN KEY (species_id_id) REFERENCES species (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_6AAB231FC6A6D2CB ON animal (species_id_id)');
        $this->addSql('ALTER TABLE breed ADD species_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE breed ADD CONSTRAINT FK_F8AF884FC6A6D2CB FOREIGN KEY (species_id_id) REFERENCES species (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_F8AF884FC6A6D2CB ON breed (species_id_id)');
        $this->addSql('ALTER TABLE donation ADD user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE donation ADD CONSTRAINT FK_31E581A09D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_31E581A09D86650F ON donation (user_id_id)');
        $this->addSql('ALTER TABLE "like" ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE "like" ADD animal_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE "like" DROP user_id');
        $this->addSql('ALTER TABLE "like" DROP animal_id');
        $this->addSql('ALTER TABLE "like" ADD CONSTRAINT FK_AC6340B39D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "like" ADD CONSTRAINT FK_AC6340B35EB747A3 FOREIGN KEY (animal_id_id) REFERENCES animal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_AC6340B39D86650F ON "like" (user_id_id)');
        $this->addSql('CREATE INDEX IDX_AC6340B35EB747A3 ON "like" (animal_id_id)');
        $this->addSql('ALTER TABLE review ADD spa_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review ADD user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review ADD spa_user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6EA08EE17 FOREIGN KEY (spa_id_id) REFERENCES spa (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C69D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE review ADD CONSTRAINT FK_794381C6DBFC9721 FOREIGN KEY (spa_user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_794381C6EA08EE17 ON review (spa_id_id)');
        $this->addSql('CREATE INDEX IDX_794381C69D86650F ON review (user_id_id)');
        $this->addSql('CREATE INDEX IDX_794381C6DBFC9721 ON review (spa_user_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE behaviour_animal DROP CONSTRAINT FK_D5B552DCF3A0E8C5');
        $this->addSql('ALTER TABLE behaviour_animal DROP CONSTRAINT FK_D5B552DC8E962C16');
        $this->addSql('DROP TABLE behaviour_animal');
        $this->addSql('ALTER TABLE donation DROP CONSTRAINT FK_31E581A09D86650F');
        $this->addSql('DROP INDEX IDX_31E581A09D86650F');
        $this->addSql('ALTER TABLE donation DROP user_id_id');
        $this->addSql('ALTER TABLE breed DROP CONSTRAINT FK_F8AF884FC6A6D2CB');
        $this->addSql('DROP INDEX IDX_F8AF884FC6A6D2CB');
        $this->addSql('ALTER TABLE breed DROP species_id_id');
        $this->addSql('ALTER TABLE animal DROP CONSTRAINT FK_6AAB231FC6A6D2CB');
        $this->addSql('DROP INDEX IDX_6AAB231FC6A6D2CB');
        $this->addSql('ALTER TABLE animal DROP species_id_id');
        $this->addSql('ALTER TABLE agenda DROP CONSTRAINT FK_2CEDC877EA08EE17');
        $this->addSql('ALTER TABLE agenda DROP CONSTRAINT FK_2CEDC8779D86650F');
        $this->addSql('ALTER TABLE agenda DROP CONSTRAINT FK_2CEDC877DBFC9721');
        $this->addSql('DROP INDEX IDX_2CEDC877EA08EE17');
        $this->addSql('DROP INDEX IDX_2CEDC8779D86650F');
        $this->addSql('DROP INDEX IDX_2CEDC877DBFC9721');
        $this->addSql('ALTER TABLE agenda DROP spa_id_id');
        $this->addSql('ALTER TABLE agenda DROP user_id_id');
        $this->addSql('ALTER TABLE agenda DROP spa_user_id_id');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C6EA08EE17');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C69D86650F');
        $this->addSql('ALTER TABLE review DROP CONSTRAINT FK_794381C6DBFC9721');
        $this->addSql('DROP INDEX IDX_794381C6EA08EE17');
        $this->addSql('DROP INDEX IDX_794381C69D86650F');
        $this->addSql('DROP INDEX IDX_794381C6DBFC9721');
        $this->addSql('ALTER TABLE review DROP spa_id_id');
        $this->addSql('ALTER TABLE review DROP user_id_id');
        $this->addSql('ALTER TABLE review DROP spa_user_id_id');
        $this->addSql('ALTER TABLE "like" DROP CONSTRAINT FK_AC6340B39D86650F');
        $this->addSql('ALTER TABLE "like" DROP CONSTRAINT FK_AC6340B35EB747A3');
        $this->addSql('DROP INDEX IDX_AC6340B39D86650F');
        $this->addSql('DROP INDEX IDX_AC6340B35EB747A3');
        $this->addSql('ALTER TABLE "like" ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE "like" ADD animal_id INT NOT NULL');
        $this->addSql('ALTER TABLE "like" DROP user_id_id');
        $this->addSql('ALTER TABLE "like" DROP animal_id_id');
    }
}
