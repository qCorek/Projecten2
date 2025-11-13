-- -----------------------------------------------------
-- Database: film
-- -----------------------------------------------------

CREATE DATABASE IF NOT EXISTS film;
USE film;

-- -----------------------------------------------------
-- Tabel: films
-- -----------------------------------------------------
CREATE TABLE films (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filmnaam VARCHAR(255) NOT NULL,
    genre VARCHAR(100) NOT NULL
);

-- -----------------------------------------------------
-- Tabel: acteurs
-- -----------------------------------------------------
CREATE TABLE acteurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    acteurnaam VARCHAR(255) NOT NULL
);

-- -----------------------------------------------------
-- Koppeltabel: film_acteur
-- (Veel-op-veel relatie tussen films en acteurs)
-- -----------------------------------------------------
CREATE TABLE film_acteur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    film_id INT NOT NULL,
    acteur_id INT NOT NULL,

    CONSTRAINT fk_film
        FOREIGN KEY (film_id) REFERENCES films(id)
        ON DELETE CASCADE,

    CONSTRAINT fk_acteur
        FOREIGN KEY (acteur_id) REFERENCES acteurs(id)
        ON DELETE CASCADE
);


INSERT INTO films (filmnaam, genre) VALUES
('Inception', 'Science Fiction'),
('The Godfather', 'Crime');

INSERT INTO acteurs (acteurnaam) VALUES
('Leonardo DiCaprio'),
('Marlon Brando'),
('Al Pacino');

INSERT INTO film_acteur (film_id, acteur_id) VALUES
(1, 1), -- Inception → Leonardo DiCaprio
(2, 2), -- The Godfather → Marlon Brando
(2, 3); -- The Godfather → Al Pacino
