<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211011093613 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE LigneFraisForfait DROP FOREIGN KEY LigneFraisForfait_ibfk_1');
        $this->addSql('ALTER TABLE LigneFraisHorsForfait DROP FOREIGN KEY LigneFraisHorsForfait_ibfk_1');
        $this->addSql('ALTER TABLE LigneFraisForfait DROP FOREIGN KEY LigneFraisForfait_ibfk_2');
        $this->addSql('CREATE TABLE fiche_frais (id INT AUTO_INCREMENT NOT NULL, mois VARCHAR(3) NOT NULL, nb_justificatifs INT NOT NULL, montant_valide INT NOT NULL, date_modif DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE frais_forfait (id INT AUTO_INCREMENT NOT NULL, frais_forfait_libelle VARCHAR(255) NOT NULL, montant INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_frais_forfait (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_frais_hors_forfait (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, montant INT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE FicheFrais');
        $this->addSql('DROP TABLE FraisForfait');
        $this->addSql('DROP TABLE LigneFraisForfait');
        $this->addSql('DROP TABLE LigneFraisHorsForfait');
        $this->addSql('ALTER TABLE Etat ADD etat_libelle VARCHAR(255) NOT NULL, DROP libelle, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE Visiteur ADD date_embauche DATE NOT NULL, DROP dateEmbauche, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE nom nom VARCHAR(50) NOT NULL, CHANGE prenom prenom VARCHAR(50) NOT NULL, CHANGE login login VARCHAR(15) NOT NULL, CHANGE mdp mdp VARCHAR(10) NOT NULL, CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE cp cp VARCHAR(7) NOT NULL, CHANGE ville ville VARCHAR(70) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE FicheFrais (mois CHAR(6) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idVisiteur CHAR(4) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, nbJustificatifs INT DEFAULT NULL, montantValide NUMERIC(10, 2) DEFAULT \'NULL\', dateModif DATE DEFAULT \'NULL\', idEtat CHAR(2) CHARACTER SET utf8mb4 DEFAULT \'\'\'CR\'\'\' COLLATE `utf8mb4_general_ci`, INDEX idEtat (idEtat), INDEX IDX_1C4987DC1D06ADE3 (idVisiteur), PRIMARY KEY(idVisiteur, mois)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE FraisForfait (id CHAR(3) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, libelle CHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, montant NUMERIC(5, 2) DEFAULT \'NULL\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE LigneFraisForfait (mois CHAR(6) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idVisiteur CHAR(4) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idFraisForfait CHAR(3) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, quantite INT DEFAULT NULL, INDEX idFraisForfait (idFraisForfait), INDEX IDX_146093DC1D06ADE3D6B08CB7 (idVisiteur, mois), PRIMARY KEY(idVisiteur, mois, idFraisForfait)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE LigneFraisHorsForfait (id INT AUTO_INCREMENT NOT NULL, mois CHAR(6) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, idVisiteur CHAR(4) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, libelle VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, date DATE DEFAULT \'NULL\', montant NUMERIC(10, 2) DEFAULT \'NULL\', INDEX idVisiteur (idVisiteur, mois), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE FicheFrais ADD CONSTRAINT FicheFrais_ibfk_1 FOREIGN KEY (idEtat) REFERENCES Etat (id)');
        $this->addSql('ALTER TABLE FicheFrais ADD CONSTRAINT FicheFrais_ibfk_2 FOREIGN KEY (idVisiteur) REFERENCES Visiteur (id)');
        $this->addSql('ALTER TABLE LigneFraisForfait ADD CONSTRAINT LigneFraisForfait_ibfk_1 FOREIGN KEY (idVisiteur, mois) REFERENCES FicheFrais (idVisiteur, mois)');
        $this->addSql('ALTER TABLE LigneFraisForfait ADD CONSTRAINT LigneFraisForfait_ibfk_2 FOREIGN KEY (idFraisForfait) REFERENCES FraisForfait (id)');
        $this->addSql('ALTER TABLE LigneFraisHorsForfait ADD CONSTRAINT LigneFraisHorsForfait_ibfk_1 FOREIGN KEY (idVisiteur, mois) REFERENCES FicheFrais (idVisiteur, mois)');
        $this->addSql('DROP TABLE fiche_frais');
        $this->addSql('DROP TABLE frais_forfait');
        $this->addSql('DROP TABLE ligne_frais_forfait');
        $this->addSql('DROP TABLE ligne_frais_hors_forfait');
        $this->addSql('ALTER TABLE etat ADD libelle VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, DROP etat_libelle, CHANGE id id CHAR(2) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`');
        $this->addSql('ALTER TABLE visiteur ADD dateEmbauche DATE DEFAULT \'NULL\', DROP date_embauche, CHANGE id id CHAR(4) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, CHANGE nom nom CHAR(30) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, CHANGE prenom prenom CHAR(30) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, CHANGE adresse adresse CHAR(30) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, CHANGE ville ville CHAR(30) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, CHANGE cp cp CHAR(5) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, CHANGE login login CHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`, CHANGE mdp mdp CHAR(20) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_general_ci`');
    }
}
