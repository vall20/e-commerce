CREATE DATABASE site_e_commerce;

CREATE TABLE `site_e_commerce`.`produits`
 (`id_prod` INT NOT NULL AUTO_INCREMENT , 
 `nom_prod` VARCHAR(255) NOT NULL , 
 `image_prod` TEXT NOT NULL , 
 `prix_prod` FLOAT(25) NOT NULL , 
 `description_prod` TEXT NOT NULL , PRIMARY KEY (`id_prod`)) 
 ENGINE = InnoDB;

 

 CREATE TABLE `site_e_commerce`.`panier` (
    `id` INT(11) NOT NULL AUTO_INCREMENT , 
    `nom` VARCHAR(255) NOT NULL , 
    `img` TEXT NOT NULL , 
    `prix` FLOAT(15) NOT NULL , 
    `quantité` INT(11) NOT NULL , PRIMARY KEY (`id`)
    ) 
    ENGINE = InnoDB;
    CREATE TABLE `site_e_commerce`.`user` (
      `id_user` INT(11) NOT NULL AUTO_INCREMENT ,
       `nom` VARCHAR(50) NOT NULL ,
        `prenom` VARCHAR(50) NOT NULL ,
         `email` VARCHAR(255) NOT NULL ,
          `mot_de_passe` TEXT NOT NULL , 
          `adresse` TEXT NOT NULL ,
           `ville` VARCHAR(50) NOT NULL , 
           `code_postal` INT NOT NULL , 
           `departement` TEXT NOT NULL , 
           PRIMARY KEY (`id_user`)
           ) ENGINE = InnoDB;

           CREATE TABLE `site_e_commerce`.`tb_admin` (
            `id_admin` INT NOT NULL AUTO_INCREMENT ,
             `email` TEXT NOT NULL , 
             `mot_de_passe` TEXT NOT NULL , 
             PRIMARY KEY (`id_admin`)
             ) ENGINE = InnoDB;


             INSERT INTO `tb_admin` (`id_admin`, `email`, `mot_de_passe`) VALUES (NULL, 'valdyestepha@gmail.com', 'val');

   
CREATE TABLE panier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_prod INT NOT NULL,
    id_user INT NOT NULL,
    quantite INT NOT NULL,
    nom VARCHAR(255) NOT NULL , 
    img TEXT NOT NULL , 
    prix FLOAT(15) NOT NULL ,
    FOREIGN KEY (id_prod) REFERENCES produits(id_prod),
     FOREIGN KEY (id_user) REFERENCES user(id_user)
);


INSERT INTO produits (nom_prod, image_prod, description_prod, prix_prod) VALUES
('Chaussures de course', 'https://th.bing.com/th/id/OIP.S4Ab5ye4F48jinhfAW5U9QHaD3?w=269&h=180&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Des chaussures légères et confortables pour vos courses.', 89.99),
('T-shirt sport', 'https://th.bing.com/th/id/OIP.yehrBTBeG6gksz8E3Zp81QHaHa?w=176&h=180&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'T-shirt respirant parfait pour les activités sportives.', 29.99),

('Haltères', 'https://th.bing.com/th/id/OIP.fA-_74ZLTc5YGtYHM36FlgAAAA?w=286&h=191&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Set d’haltères réglables, idéal pour l’entraînement de force.', 89.99),
('Veste imperméable', 'https://th.bing.com/th/id/OIP.VdpMzw6CpucYpG_-YdL9hQHaHa?w=198&h=199&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Veste légère et imperméable, idéale pour les activités en extérieur.', 129.99),
('Chaussures de trail', 'https://th.bing.com/th/id/OIP.-SLLVP3319YzMl9wsEHeYwHaFB?w=258&h=180&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Chaussures de trail robustes avec une excellente adhérence.', 99.99),
('Bande de résistance', 'https://th.bing.com/th/id/OIP.DY3WtXm6i4LYvcQYtAMcPwHaHH?w=185&h=180&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Bandes de résistance pour vos exercices de musculation à domicile.', 15.99),
('Vélo de route', 'https://th.bing.com/th/id/OIP.NIj5cATLJpCAFwMm6sHvvwAAAA?w=252&h=180&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Vélo de route léger et rapide, parfait pour les longues balades.', 999.99),
('Gilet de sécurité', 'https://th.bing.com/th/id/OIP.MUgjgXLMQDsCVBikW9Wn7gHaKj?w=144&h=206&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Gilet réfléchissant pour vos sorties nocturnes en vélo ou à pied.', 24.99),
('Chaussures de randonnée', 'https://images.unsplash.com/photo-1585910126443-3fc9e00d22d1', 'Chaussures robustes pour les randonnées en montagne.', 119.99),
('Bracelets de fitness', 'hhttps://th.bing.com/th/id/OIP.VxPSgoHhuLdZWSMVZNeyPgHaFj?w=248&h=185&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Bracelets de fitness pour suivre vos activités sportives.', 39.99),
('Ballon de basket', 'https://th.bing.com/th/id/OIP.DulJJCNJggTgQksgoImr5QHaHa?w=199&h=199&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Ballon de basket de haute qualité, idéal pour les matchs et les entraînements.', 29.99);

INSERT INTO produits (nom_prod, prix_prod, image_prod, description_prod)
VALUES 
    ('Apple iPhone 14', 999.99, 'https://th.bing.com/th/id/OIP.KyrBu1s2mkrqDl3Bdo8QtAHaHa?w=180&h=180&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Smartphone Apple avec écran de 6,1 pouces, processeur A15 et appareil photo de 12 MP.'),
    ('Samsung Galaxy S22', 849.99, 'https://th.bing.com/th/id/OIP.-0NbIs-Y4jGWYw2BaqyK-wHaHa?w=166&h=180&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Smartphone Samsung avec écran de 6,1 pouces, processeur Exynos 2200 et appareil photo de 50 MP.'),
    ('Sony WH-1000XM4', 349.99, 'https://th.bing.com/th/id/OIP.B4ZpRhAkszS_lq1SDFfA9gHaHa?w=188&h=188&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Casque à réduction de bruit avec qualité sonore exceptionnelle et autonomie de 30 heures.'),
    ('Dell XPS 13', 1199.99, 'https://th.bing.com/th/id/OIP.u-WMhEdVK8Djt3-3mB5x_AHaF7?w=219&h=180&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Ordinateur portable léger avec écran InfinityEdge de 13,4 pouces et processeur Intel Core i7.'),
    ('Fitbit Charge 5', 179.99, 'https://th.bing.com/th/id/OIP.NqPykbRvQMs8PGxcIgD3fgHaEK?w=329&h=185&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Montre connectée avec suivi de la santé, GPS intégré et notifications intelligentes.');


INSERT INTO produits (nom_prod, prix_prod, image_prod, description_prod) VALUES
('Asus ROG Zephyrus G14', 1499.99, 'https://th.bing.com/th/id/OIP.Jr_VkH8M_Yv1Foox8KznIgHaE1?w=238&h=180&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Ordinateur portable gamer ultra performant avec processeur AMD Ryzen 9 et carte graphique NVIDIA GeForce RTX 3060. Écran de 14 pouces avec un taux de rafraîchissement de 120Hz.'),
('Alienware Aurora R12', 1999.99, 'https://th.bing.com/th/id/OIP.aneuidesXjC9pkiOr69AHAHaEK?w=267&h=180&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'PC de jeu de bureau avec un design emblématique, équipé de processeurs Intel de 11e génération et de cartes graphiques NVIDIA RTX 3080. Conçu pour les gamers exigeants.'),
('PlayStation 5', 499.99, 'https://th.bing.com/th/id/OIP.OcJRg5pD-4fDETVqIsOpeQHaE7?w=233&h=180&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Console de jeu nouvelle génération avec des graphismes époustouflants, un SSD ultra-rapide et une bibliothèque de jeux exclusive. Idéale pour les amateurs de jeux vidéo.'),
('Xbox Series X', 499.99, 'https://th.bing.com/th/id/OIP.hSQsQkhPTFXJImNOEuufcwHaEo?w=287&h=180&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Console de jeu puissante offrant des performances de jeu incroyables, un stockage rapide et un accès à une vaste bibliothèque de jeux via Xbox Game Pass.'),
('Razer BlackWidow V3', 139.99, 'https://th.bing.com/th/id/OIP.0_cOmuJs3tv0Y8Z-03kIPgHaD4?w=341&h=180&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Clavier mécanique RGB avec des interrupteurs mécaniques de haute qualité, conçu pour les gamers avec un confort de frappe exceptionnel et une personnalisation avancée.'),
('Logitech G502 HERO', 79.99, 'https://th.bing.com/th/id/OIP.zi-2FO2QyB3-4TNGGDaWgAHaG-?w=241&h=220&c=7&r=0&o=5&dpr=1.5&pid=1.7', 'Souris gamer haute performance avec capteur HERO 25K, boutons programmables et éclairage RGB. Parfaite pour une expérience de jeu immersive.');




CREATE TABLE `site_e_commerce`.`vetement` (
  `id_vet` INT NOT NULL AUTO_INCREMENT , 
  `nom_vet` INT NOT NULL , 
  `prix_vet` INT NOT NULL ,
   `image_vet` INT NOT NULL ,
    `description_vet` INT NOT NULL , 
    PRIMARY KEY (`id_vet`)) ENGINE = InnoDB;

CREATE TABLE `site_e_commerce`.`electronique` (
  `id_elec` INT NOT NULL AUTO_INCREMENT , 
  `nom_elec` INT NOT NULL , 
  `prix_elec` INT NOT NULL , 
  `image_elec` INT NOT NULL , 
  `description_elec` INT NOT NULL ,
   PRIMARY KEY (`id_elec`)) ENGINE = InnoDB;


   CREATE TABLE `site_e_commerce`.`accessoires` (
    `id_ac` INT NOT NULL AUTO_INCREMENT , 
    `nom_ac` INT NOT NULL ,
     `prix_ac` INT NOT NULL , 
     `tmage_ac` INT NOT NULL , 
     `description_ac` INT NOT NULL ,
    PRIMARY KEY (`id_ac`)) ENGINE = InnoDB;