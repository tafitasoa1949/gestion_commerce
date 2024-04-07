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


-- Inserts pour la table "fonction"
INSERT INTO fonction (nom) VALUES
    ('Fonction A'),
    ('fianace'),
    ('DAF');
INSERT INTO fonction (nom) VALUES
    ('chef departement'),
    ('chef magasin');

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

create table user_employe(
    id serial primary key,
    employe_id varchar(20) references employe(immatriculation),
    email varchar(100) not null,
    mdp varchar(50) not null
);



-- Inserts pour la table "employe"
INSERT INTO employe (immatriculation, idfonction, iddepartement, nom, prenom, adresse, contact, email) VALUES
    ('ImmatriculationA', 1, 1, 'NomA', 'PrenomA', 'AdresseA', 'ContactA', 'emailA@example.com'),
    ('ImmatriculationB', 2, 2, 'NomB', 'PrenomB', 'AdresseB', 'ContactB', 'emailB@example.com'),
    ('ImmatriculationC', 3, 3, 'NomC', 'PrenomC', 'AdresseC', 'ContactC', 'emailC@example.com');

    INSERT INTO employe (immatriculation, idfonction, iddepartement, nom, prenom, adresse, contact, email) VALUES
    ('EMP1', 3, 1, 'Deba', 'kely', '123', '00443455', 'daba@gmail.com'),
    ('EMP2', 4, 1, 'Tina', 'Tsou', '5959', '34436678', 'tsou@gmail.com');

-- Inserts pour la table "user_employe"
INSERT INTO user_employe (employe_id, email, mdp) VALUES
    ('ImmatriculationA', 'userA@example.com', 'mdpA'),
    ('ImmatriculationB', 'userB@example.com', 'mdpB'),
    ('ImmatriculationC', 'userC@example.com', 'mdpC');

    INSERT INTO user_employe (employe_id, email, mdp) VALUES
    ('EMP1', 'finance@gmail.com', 'finance'),
    ('EMP2', 'chef@gmail.com', 'chef');

--view getusers
create or replace view users as
select f.id,e.nom, e.prenom, f.nom as fonction, ue.employe_id, ue.email, ue.mdp,e.iddepartement
from employe as e join fonction as f on e.idfonction = f.id
join user_employe as ue on e.immatriculation = ue.employe_id;


create table materiel(
    id serial primary key,
    nom varchar(100) not null,
    iddepartement int references departement(id)
);

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
    email varchar(50) unique,
    nif varchar(50),
    stat varchar(50)
);

-- Insertion de données dans la table fournisseur
INSERT INTO fournisseur (nom, prenom, adresse, contact, email, nif, stat)
VALUES
    ('ABC Electronics', 'John', '123 Main Street, Cityville', '555-1234', 'john@abc.com','123343KO4','233442LL2-H'),
    ('Tech Solutions Inc.', 'Emma', '456 High Street, Tech City', '555-5678', 'emma@techsolutions.com','134FFJ9','JIJIJ2232-9'),
    ('Gadget World Ltd.', 'Michael', '789 Broad Street, Gizmotown', '555-9876', 'michael@gadgetworld.com','RTG876GG','SLDPFLK84');

INSERT INTO fournisseur (nom, prenom, adresse, contact, email, nif, stat) VALUES
    ('Dupont', 'Jean', '123 Rue de la République', '+33 123 456 789', 'jean.dupont@email.com', '123456789', 'Actif'),
    ('Martin', 'Sophie', '456 Avenue des Fleurs', '+33 987 654 321', 'sophie.martin@email.com', '987654321', 'Inactif'),
    ('Leclerc', 'Pierre', '789 Boulevard des Étoiles', '+33 555 123 456', 'pierre.leclerc@email.com', '555123456', 'En attente'),
    ('Lefevre', 'Marie', '101 Rue de la Libération', '+33 777 888 999', 'marie.lefevre@email.com', '777888999', 'Actif');



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

create view gePproduit_fournisseur as
select pf.id, pf.nom as produit ,pf.prix, f.nom as fournisseur, f.id as id_fournisseur
from produit_fournisseur as pf join fournisseur as f on pf.idfournisseur = f.id  ORDER by pf.prix ASC;


create table detail_produit_fournisseur(
    idproduitfournisseur int references produit_fournisseur(id),
    prix double precision,
    date timestamp
);

create table tva(
    id serial primary key,
    taux double precision,
    date timestamp
);

INSERT INTO tva (taux, date)
VALUES (0.20, '2022-11-17 12:15:00');

create table besoin(
    id serial primary key,
    iddepartement int references departement(id),
    idmateriel int references materiel(id),
    quantite double precision,
    date timestamp not null,
    idstatut smallint not null
);


--view liste_demande
create view liste_demande as
select b.id, d.nom as departement, m.nom as materiel, b.quantite, b.date, b.idstatut as etat
from besoin as b join departement as d on b.iddepartement = d.id
join materiel as m on b.idmateriel = m.id;

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
    idproforma int references proforma(id),
    montant_total double precision,
    date timestamp
);

create table detail_bondecommande(
    idbondecommande int references bondecommande(id),
    idproduitfournisseur int references produit_fournisseur(id),
    quantite double precision,
    prix_horstaxe double precision,
    tva double precision
);




create or replace view besoinencours as SELECT b.id, d.nom as departement, m.nom as materiel, b.quantite
FROM besoin b
JOIN departement d ON d.id=b.iddepartement
JOIN materiel m ON m.id=b.idmateriel
LEFT JOIN finie f ON b.id = f.idbesoin
WHERE f.idbesoin IS NULL and b.idstatut = 20;

create or replace view getproforma as SELECT p.id,p.idbesoin,f.id as idfournisseur,f.nom,f.prenom,p.montant,p.date
from proforma p
JOIN fournisseur f ON f.id=p.idfournisseur;

create or replace view getdetailproforma as SELECT det.idproforma,pr.id as idproduitfournisseur,pr.nom as produit,det.quantite,det.prix_ttc
from detail_proforma as det
JOIN produit_fournisseur pr on pr.id=det.idproduitfournisseur;

create or replace view getlistbondecommande as SELECT b.id,d.nom as departement,f.nom,f.prenom,b.montant_total,b.date
from bondecommande b
JOIN proforma pro ON pro.id=b.idproforma
JOIN besoin ON besoin.id=pro.idbesoin
JOIN fournisseur f ON f.id=pro.idfournisseur
JOIN departement d ON d.id=besoin.iddepartement where besoin.idstatut =10;

create or replace view getdetailbondecommande as SELECT det.idbondecommande,pr.id,pr.nom,det.quantite,det.prix_horstaxe,det.tva
from detail_bondecommande det
JOIN produit_fournisseur pr on pr.id=det.idproduitfournisseur;


-- new table

create table mouvement(
    id serial primary key,
    id_produit int references produit_fournisseur(id),
    stock double precision
);

insert into mouvement values(default,3,1000);


create or replace view getMouvement as
select m.id ,m.id_produit,m.stock, pf.id as id_fournisseur, pf.nom ,pf.prix
from mouvement as m join produit_fournisseur as pf on m.id_produit = pf.id;

create table userfournisseur(

    id serial primary key,
    email text not null,
    mdp text not null,
    id_fournisseur int references fournisseur(id)
);

insert into userfournisseur values(default,'abc@gmail.com','abc',1);
insert into userfournisseur values(default,'tech@gmail.com','tech',2);

CREATE table employer_fournisseur(
    id serial primary key,
    id_fournisseur int references fournisseur(id),
    nom varchar(100) not null,
    adresse varchar (100),
    contact integer,
    poste varchar(100)
);


CREATE table bondelivraison(
    id VARCHAR(100) primary key,
    idbondecommande int references bondecommande(id),
    quantite double precision,
    id_employerfournisseur int references employer_fournisseur(id),
    datedelivraison timestamp

);



CREATE Table bondereception(
    id VARCHAR(100) primary key,
    employe_id varchar(20) references employe(immatriculation),
    produit varchar(50),
    quantite double precision,
    title varchar(100),
    datedereception timestamp
);

insert into bondereception values ('REC001','EMP1','Ordi portable',5,'hhuhuhu','2023-12-06');
insert into bondereception values ('REC002','EMP2','Samsing',2,'KKKKNJBBB','2023-12-04');

create or replace view v_bondereception as SELECT * FROM bondereception as br join employe as e ON br.employe_id = e.immatriculation;

CREATE table magasinnier(
    id serial primary key,
    nom varchar(100),
    identreprise int references entreprise(id),
    reponsable varchar(20) references employe(immatriculation)
);

insert into magasinnier values(default,'Hein Bisou',1,'EMP1');

CREATE table mouvementachat (
    id_bondereception VARCHAR(100) references bondereception(id),
    idmagasin int references magasinnier(id),
    date timestamp
);

create table partage_dept(
    id_bondereception VARCHAR(100) references bondereception(id),
    iddepartement int references departement(id),
    quantite double precision,
    date timestamp
);

create or replace view v_depot as select bon.id,bon.produit,bon.quantite as quantite,m.date from bondereception as bon
left join mouvementachat as m on m.id_bondereception=bon.id
where m.id_bondereception is not null order by bon.id desc;



