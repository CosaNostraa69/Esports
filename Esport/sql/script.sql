-- Débute le script
START TRANSACTION;
-- Supprime la bdd si ell existe, idéal pour repartir de 0
DROP DATABASE IF EXISTS esport_Data;
-- Crée la bdd
CREATE DATABASE IF NOT EXISTS esport_Data;
-- séléctionne la bdd
USE esport_Data;
-- Crée une table dans la bdd
CREATE TABLE IF NOT EXISTS game (
    id INT(10) NOT NULL AUTO_INCREMENT,
    name VARCHAR(50),
    station VARCHAR(50),
    format VARCHAR(80),
    PRIMARY KEY (id)
);
-- Crée une table dans la bdd
CREATE TABLE IF NOT EXISTS team  ( 
    id INT(10) NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(500) NOT NULL,
    deleted BOOLEAN NOT NULL DEFAULT FALSE,
    PRIMARY KEY (id)

);
-- Crée une table dans la bdd
CREATE TABLE IF NOT EXISTS sponsor (
    id INT(10) NOT NULL AUTO_INCREMENT,
    brand VARCHAR(50) NOT NULL,
    team_id INT(10),
    CONSTRAINT fk_sponsor_team FOREIGN KEY (team_id) REFERENCES team(id) ON DELETE
    SET NULL,
        PRIMARY KEY (id)
);
-- Crée une table dans la bdd
CREATE TABLE IF NOT EXISTS competition (
    id INT(10) NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(300) NOT NULL,
    city VARCHAR(70) NOT NULL,
    format VARCHAR(80) NOT NULL,
    cash_prize INT(9) NOT NULL,
    PRIMARY KEY (id)
);
-- Crée une table dans la bdd
CREATE TABLE IF NOT EXISTS player (
    id INT(10) NOT NULL AUTO_INCREMENT,
    first_name VARCHAR(50),
    second_name VARCHAR(50),
    city VARCHAR(70),
    team_id INT(10),
    game_id INT(10),
    CONSTRAINT fk_player_team FOREIGN KEY (team_id) REFERENCES team(id) ON DELETE
    SET NULL,
        CONSTRAINT fk_player_game FOREIGN KEY (game_id) REFERENCES game(id),
        PRIMARY KEY (id)
);
INSERT INTO `game` (`name`, `station`, `format`)
VALUES ('League of Legends', 'PC', 'MOBA'),
    ('Dota 2', 'PC', 'MOBA'),
    ('Counter-Strike: Global Offensive', 'PC', 'FPS'),
    ('Overwatch ', 'Xbox One', 'FPS'),
    ('Fortnite', 'PlayStation 4', 'Battle Royale'),
    ('Valorant', 'PC', 'FPS'),
    (
        'Hearthstone',
        'PC',
        'Jeu de cartes à collectionner'
    ),
    ('Rocket League', 'PC', 'Sport'),
    ('Rainbow Six Siege', 'PC', 'FPS tactique'),
    ('Street Fighter V', 'PlayStation 4', 'Combat');
INSERT INTO `competition` (
        `name`,
        `description`,
        `city`,
        `format`,
        `cash_prize`
    )
VALUES (
        'Thunderdome',
        'Championnat CS: Global Offensive',
        'Las Vegas',
        'Battle Royale',
        100000
    ),
    (
        'Frostbite',
        'Coupe de France Dota',
        'France',
        'FPS',
        50000
    ),
    (
        'Cyberstorm',
        'Championnat League of Legends',
        'Québec',
        'MOBA',
        250000
    );
INSERT INTO `team` (`name`, `description`)
VALUES ('Team Liquid', 'Équipe Dota 2'),
    ('SK Telecom T1', 'Équipe de League of Legends'),
    (
        'Astralis',
        'Équipe de Counter-Strike: Global Offensive'
    );
INSERT INTO `player` (
        `first_name`,
        `second_name`,
        `city`,
        `team_id`,
        `game_id`
    )
VALUES ('Lee (Faker)', 'Sang-hyeok', 'Séoul', 2, 1),
    ('Oleksandr (s1mple)', 'Kostyliev', 'Kiev', 3, 1),
    ('Lee (Jaedong)', 'Jae-dong', 'Ulsan', 2, 3),
    ('Gabrie
l (FalleN)', 'Toledo', 'Itararé', 3, 2),
    ('Marcelo (coldzera)', 'David', 'São Paulo', 3, 3),
    ('Cho (Miro)', 'Seong-ju', 'Busan', 1, 2),
    ('Amer (Miracle-)', 'Al-Barkawi', '', 1, 5),
    ('Peter (ppd)', 'Dager', 'Fort Wayne', 1, 4);
INSERT INTO `sponsor` (`brand`, `team_id`)
VALUES ('Red Bull', 1),
    ('Intel', 1),
    ('Coca-Cola', 2),
    ('Logitech G', 3),
    ('HyperX', 2);
-- Termine le Script
COMMIT;