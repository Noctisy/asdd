-- Yusa Celiker

CREATE TABLE Medewerker(
    id INT NOT NULL AUTO_INCREMENT,
    voorletters VARCHAR(250) NOT NULL,
    voorvoegsels VARCHAR(250),
    Achternaam VARCHAR(250) NOT NULL,
    Gebruikersnaam VARCHAR(250) NOT NULL,
    Wachtwoord VARCHAR(250),
    PRIMARY KEY(id)
);

CREATE TABLE fabriek (
 id int(11) NOT NULL AUTO_INCREMENT,
 Fabriek varchar(250) NOT NULL,
 Telefoon int(11) NOT NULL,
 PRIMARY KEY id)

 CREATE TABLE locatie (
  id int(11) NOT NULL AUTO_INCREMENT,
  locatie varchar(250) DEFAULT NULL,
  PRIMARY KEY (id)

  CREATE TABLE `voorraad` (
   id int(11) NOT NULL AUTO_INCREMENT,
   locatie_id int(11) NOT NULL,
   artikel_id int(11) NOT NULL,
   aantal int(11) DEFAULT NULL,
   PRIMARY KEY (id),
   FOREIGN KEY locatie_id REFERENCES (locatie_id),
   FOREIGN KEY artikel_id REFERENCES (artikel_id)

  CREATE TABLE `artikel` (
    id int(11) NOT NULL AUTO_INCREMENT,
    fabriek_id int(11) NOT NULL,
    product varchar(250) NOT NULL,
    Type varchar(250) NOT NULL,
    inkoopprijs decimal(10,2) NOT NULL,
    verkooprprijs decimal(10,2) NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY `fabriek_id` REFERENCES (fabriek_id)
