create database pointage;
use pointage;

create table administrateur (
    id_administrateur int primary key auto_increment,
    nom_administrateur varchar(100) check(length(nom_administrateur) > 2),
    mot_de_passe varchar(40) check(length(mot_de_passe) = 40)
) ENGINE=InnoDB;

create table categorie (
    id_categorie int primary key auto_increment,
    nom_categorie varchar(100) not null,
    heure double check(heure > 0 and heure < 169),
    salaire double check(salaire > 0),
    indemnite double check(indemnite >= 0)
) ENGINE=InnoDB;

create table employee (
    id_employee int primary key auto_increment,
    nom_employee varchar(200) check(length(nom_employee) > 1),
    matricule varchar(7) unique check(length(matricule) = 7),
    dt_naissance date not null,
    dt_embauche date not null,
    dt_fin_contrat date default null,
    categorie_emp int,
    mot_de_passe varchar(40) check(length(mot_de_passe) > 0),
    actif boolean default true,
    foreign key (categorie_emp) references categorie(id_categorie)
) ENGINE=InnoDB;

create table h_supplementaire (
    id_h_supplementaire int primary key auto_increment,
    designation varchar(20) not null,
    h_max int check(h_max >= 0),
    pourcentage double check(pourcentage >= 0)
) ENGINE=InnoDB;

create table h_majoree (
    id_h_majoree int primary key auto_increment,
    designation varchar(20) not null,
    pourcentage double check(pourcentage >= 0)
) ENGINE=InnoDB;

create table pointage_mere (
    id_pointage_mere int primary key auto_increment,
    id_employee int,
    dt_enregistrement date,
    foreign key (id_employee) references employee(id_employee),
    CONSTRAINT UC_employee UNIQUE (id_employee)
) ENGINE=InnoDB;

create table pointage_fille (
    id_pointage_fille int primary key auto_increment,
    id_pointage_mere int,
    jour int check(jour>-1 and jour<8),
    h_jour double default 0 check(h_jour>=0 and h_jour<=24) ,
    h_nuit double default 0 check(h_nuit>=0 and h_nuit<=24),
    h_ferie double default 0 check(h_ferie>=0 and h_ferie<=24),
    foreign key (id_pointage_mere) references pointage_mere(id_pointage_mere),
    CONSTRAINT UC_jour UNIQUE (id_pointage_mere,jour)
) ENGINE=InnoDB;

create table indemnite(
    id int primary key auto_increment,
    pourcentage double check(pourcentage >= 0 and pourcentage <= 100)
) ENGINE=InnoDB;

create table impot(
    id int primary key auto_increment,
    pourcentage double check(pourcentage >= 0 and pourcentage <= 100)
) ENGINE=InnoDB;