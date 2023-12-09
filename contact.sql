-- Table pour les catégories
CREATE TABLE IF NOT EXISTS categorie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(50) NOT NULL
);

-- Table pour les contacts
CREATE TABLE IF NOT EXISTS contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    categorie_id INT,
    FOREIGN KEY (categorie_id) REFERENCES categorie(id)
);

-- Exemple d'insertion de données dans la table catégorie
INSERT INTO categorie (libelle) VALUES
    ('Amis'),
    ('Famille'),
    ('Collègues');