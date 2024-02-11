/*

CREATE TABLE utilisateurs (

	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,

	username VARCHAR(255) NOT NULL,

	password VARCHAR(255) NOT NULL,

	date_creation DATE NOT NULL

);

*/

/*

CREATE TABLE categories (

	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,

	libelle VARCHAR(255) NOT NULL,

	description VARCHAR(255) NOT NULL,

	date_creation DATE NOT NULL

);

*/

/*

CREATE TABLE produits (

	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,

	libelle VARCHAR(255) NOT NULL,

	prix DECIMAL NOT NULL,
    
    discount INT,
    
    id_categorie INT NOT NULL,

	date_creation DATETIME NOT NULL

);

*/

# ALTER TABLE produits ADD CONSTRAINT FK_categorie FOREIGN KEY (id_categorie) REFERENCES categories(id);

# TRUNCATE utilisateurs;

# TRUNCATE categories;

# TRUNCATE produits;


# ALTER TABLE produits ADD description VARCHAR(255);

/*

CREATE TABLE ligne_commande (

	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,

	id_produit INT NOT NULL,

	prix DECIMAL NOT NULL,
    
	quantity INT NOT NULL,

	total DECIMAL NOT NULL

);

*/

# ALTER TABLE ligne_commande ADD CONSTRAINT FK_commande FOREIGN KEY (id_produit) REFERENCES produits(id);

# ALTER TABLE ligne_commande ADD id_commande INT;

# ALTER TABLE ligne_commande ADD CONSTRAINT FK_ligne_commande FOREIGN KEY (id_commande) REFERENCES commande(id);

/*

CREATE TABLE commande (

	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,

	id_client INT NOT NULL,
    
	total DECIMAL NOT NULL,
    
    date_creation TIMESTAMP NOT NULL

);

*/

# ALTER TABLE commande ADD CONSTRAINT FK_utilisateur_commande FOREIGN KEY (id_client) REFERENCES utilisateurs(id);

ALTER TABLE commande ADD valider INT DEFAULT 0;
