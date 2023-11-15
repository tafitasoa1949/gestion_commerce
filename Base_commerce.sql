create database gestion_commerce;
\c gestion_commerce;

create table entreprise (
    id serial primary key,
    nom varchar(100) not null,
    adresse varchar(50) not null,
    contact varchar(50),
    email varchar(50) unique
);

INSERT INTO entreprise (nom, adresse, contact, email)
VALUES
    ('Tech Innovators', '789 Tech Street, Technocity', '555-9876', 'info@techinnovators.com');

create table departement(
    id serial primary key,
    nom varchar(100) not null,
    identreprise int references entreprise(id)
);

INSERT INTO departement (nom, identreprise)
VALUES
    ('R&D', 1),
    ('Finance', 1),
    ('IT', 1);

create table fonction (
    id serial primary key,
    nom varchar(100) not null
);

create table employe(
    immatriculation varchar(50) primary key not null,
    idfonction int references fonction(id),
    iddepartement int references departement(id),
    nom varchar(100) not null,
    prenom varchar(100) not null,
    adresse varchar(100) not null,
    contact varchar(50),
    email varchar(50) unique
);

create table materiel(
    id serial primary key,
    nom varchar(100) not null
);

INSERT INTO materiel (nom)
VALUES
    ('Ordinateur portable'),
    ('Imprimante laser'),
    ('Projecteur'),
    ('Microscope'),
    ('Chaise de bureau'),
    ('Tablette graphique');


create table banque(
    immatriculation varchar(50) primary key not null,
    nom varchar(100) not null,
    email varchar(100) not null
);

create table finance(
    numero_banquaire bigint primary key,
    identreprise int references entreprise(id)
);

create table solde_banquaire(
    idbanque varchar(50) references banque(immatriculation),
    numero_banquaire  bigint references finance(numero_banquaire),
    solde double precision
);

create table fournisseur(
    id serial primary key,
    nom varchar(100) not null,
    prenom varchar(100) not null,
    adresse varchar(100) not null,
    contact varchar(50),
    email varchar(50) unique
);

-- Insertion de données dans la table fournisseur
INSERT INTO fournisseur (nom, prenom, adresse, contact, email)
VALUES
    ('ABC Electronics', 'John', '123 Main Street, Cityville', '555-1234', 'john@abc.com'),
    ('Tech Solutions Inc.', 'Emma', '456 High Street, Tech City', '555-5678', 'emma@techsolutions.com'),
    ('Gadget World Ltd.', 'Michael', '789 Broad Street, Gizmotown', '555-9876', 'michael@gadgetworld.com');


create table produit_fournisseur(
    id serial primary key,
    idfournisseur int references fournisseur(id),
    nom varchar(100) not null,
    prix double precision
);

-- Insertion de données dans la table produit_fournisseur
INSERT INTO produit_fournisseur (idfournisseur, nom, prix)
VALUES
    (1, 'Smartphone XYZ', 499.99),
    (1, 'Laptop ABC', 899.99),
    (2, 'Tablet Pro', 349.50),
    (2, 'Printer Plus', 199.99),
    (3, 'Smart Watch 2000', 129.95),
    (3, 'Camera VisionX', 299.00);

create table detail_produit_fournisseur(
    idproduitfournisseur int references produit_fournisseur(id),
    prix double precision,
    date timestamp
);

create table tva(
    id serial primary key,
    valeur double precision,
    date timestamp
);

INSERT INTO tva (valeur, date)
VALUES (20, '2022-11-17 12:15:00');

create table besoin(
    id serial primary key,
    iddepartement int references departement(id),
    idmateriel int references materiel(id),
    quantite double precision
);

-- Supposons que les départements et le matériel existent déjà dans les tables correspondantes
INSERT INTO besoin (iddepartement, idmateriel, quantite)
VALUES
    (1, 1, 10),
    (2, 2, 5),
    (3, 3, 8);

create table finie(
    idbesoin int references besoin(id),
    date timestamp
);

create table proforma(
    id serial primary key,
    idbesoin int references besoin(id),
    idfournisseur int references fournisseur(id),
    montant double precision,
    date timestamp
);

create table detail_proforma(
    idproforma int references proforma(id),
    idproduitfournisseur int references produit_fournisseur(id),
    quantite double precision,
    prix_ttc double precision
);

create table bondecommande(
    id serial primary key,
    idfournisseur int references fournisseur(id),
    total double precision,
    date timestamp
);

create table detail_bondecommande(
    idbondecommande int references bondecommande(id),
    idproduitfournisseur int references produit_fournisseur(id),
    quantite double precision,
    prix_horstaxe double precision,
    tva double precision
);







-- Insertion de données dans la table proforma
INSERT INTO proforma (idbesoin, idfournisseur, montant, date)
VALUES
    (4, 1, 1500.00, '2023-11-15 10:30:00'),
    (5, 2, 800.50, '2023-11-16 14:45:00'),
    (6, 3, 1200.75, '2023-11-17 12:15:00');

-- Insertion de données dans la table detail_proforma
INSERT INTO detail_proforma (idproforma, idproduitfournisseur, quantite, prix_ttc)
VALUES
    (7, 19, 5, 54.95),
    (7, 20, 2, 129.99),
    (7, 21, 10, 34.95),
    (8, 22, 3, 199.99),
    (8, 23, 1, 149.50),
    (9, 24, 2, 279.00);

-- Insertion de données dans la table bondecommande
INSERT INTO bondecommande (idfournisseur, total, date)
VALUES
    (1, 1855.95, '2023-11-20 09:00:00'),
    (2, 835.45, '2023-11-21 11:30:00'),
    (3, 628.45, '2023-11-22 14:00:00');



create or replace view besoinencours as SELECT b.id, d.nom as departement, m.nom as materiel, b.quantite
FROM besoin b
JOIN departement d ON d.id=b.iddepartement
JOIN materiel m ON m.id=b.idmateriel
LEFT JOIN finie f ON b.id = f.idbesoin
WHERE f.idbesoin IS NULL;

create or replace view getproforma as SELECT p.id,p.idbesoin,f.nom,f.prenom,p.montant,p.date
from proforma p
JOIN fournisseur f ON f.id=p.idfournisseur;

create or replace view getdetailproforma as SELECT det.idproforma,pr.nom as produit,det.quantite,det.prix_ttc
from detail_proforma as det
JOIN produit_fournisseur pr on pr.id=det.idproduitfournisseur;



