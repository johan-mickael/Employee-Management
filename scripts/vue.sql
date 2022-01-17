create or replace view v_employee as
select id_employee, nom_employee, matricule, dt_naissance, mot_de_passe, TIMESTAMPDIFF(YEAR, dt_naissance, CURDATE()) AS age, dt_embauche, dt_fin_contrat, id_categorie, nom_categorie categorie_emp, actif
from employee emp
join categorie c on c.id_categorie = emp.categorie_emp;

create or replace view v_pointage as
select
id_pointage_fille, id_pointage_mere,
case when h_ferie>0 then 0
    when jour=7 then 0
    else h_jour
    end jour,
case when h_ferie>0 then 0
    when jour=7 then 0
    else h_nuit
    end nuit,
case when h_ferie>0 then 0
    when jour=7 then h_jour+h_nuit
    else 0
    end dimanche,
h_ferie,
case when h_ferie>0 then h_jour+h_nuit
    else 0
    end h_ferie_travail
from pointage_fille;

create or replace view v_pointage_sum as
select id_pointage_mere, sum(jour) jour, sum(nuit) nuit, sum(dimanche) dimanche, sum(h_ferie) ferie, sum(h_ferie_travail) ferie_travail
from v_pointage
group by id_pointage_mere;

create or replace view v_pointage_mere as
select pm.*, c.heure, c.salaire, c.salaire/c.heure salaire_heure, c.indemnite
from pointage_mere pm
join employee e on e.id_employee = pm.id_employee
join categorie c on c.id_categorie = e.categorie_emp;

create or replace view v_heure_travail as
select pf.id_pointage_mere, pm.id_employee, sum(pf.h_jour) h_jour, sum(pf.h_nuit) h_nuit, sum(h_ferie) h_ferie, pm.heure, pm.salaire, pm.salaire_heure
from pointage_fille pf
join v_pointage_mere pm on pm.id_pointage_mere = pf.id_pointage_mere
group by pf.id_pointage_mere, pm.id_employee, pm.heure;

create or replace view v_heure_supplementaire as
select h.id_pointage_mere, h.id_employee, h.h_jour, h.h_nuit, h.h_jour+h.h_nuit+h.h_ferie h_somme , h.heure, h.salaire, h.salaire_heure, ferie_travail, h.h_jour+h.h_nuit+h.h_ferie-heure-ps.ferie_travail h_supplementaire
from v_heure_travail h
join v_pointage_sum ps on ps.id_pointage_mere=h.id_pointage_mere;

create or replace view v_heure_supplementaire_detail as
select *, get_hs30(h_supplementaire) HS30, get_hs50(h_supplementaire) HS50
from v_heure_supplementaire;

create or replace view v_calcul_heure as
select hs.id_pointage_mere, id_employee, hm.jour HN, hs30, hs50, hm.nuit HM30, hm.dimanche HM40, hm.ferie HF, hm.ferie_travail HM50, (hm.jour+hm.nuit+hm.dimanche+hm.ferie+hm.ferie_travail) total_heure_travail, h_supplementaire, heure, salaire, salaire_heure
from v_pointage_sum hm
join v_heure_supplementaire_detail hs
on hm.id_pointage_mere = hs.id_pointage_mere;

-- fiche de paie
create or replace view v_calcul_salaire as
select id_pointage_mere, id_employee, 'HN' designation, HN total_heure, get_taux_hm(4) pourcentage, salaire, salaire_heure, heure from v_calcul_heure
union all
select id_pointage_mere, id_employee, 'HM30', HM30, get_taux_hm(1), salaire, salaire_heure, heure from v_calcul_heure
union all
select id_pointage_mere, id_employee, 'HM40', HM40, get_taux_hm(2), salaire, salaire_heure, heure from v_calcul_heure
union all
select id_pointage_mere, id_employee, 'HM50', HM50, get_taux_hm(3), salaire, salaire_heure, heure from v_calcul_heure
union all
select id_pointage_mere, id_employee, 'HF', HF, get_taux_hm(5), salaire, salaire_heure, heure from v_calcul_heure
union all
select id_pointage_mere, id_employee, 'HS30', HS30, get_taux_hs(1), salaire, salaire_heure, heure from v_calcul_heure
union all
select id_pointage_mere, id_employee, 'HS50', HS50, get_taux_hs(2), salaire, salaire_heure, heure from v_calcul_heure;

create or replace view v_calcul_heure_salaire as
select *, salaire_heure*pourcentage/100 taux_horaire, salaire_heure*pourcentage*total_heure/100 montant from v_calcul_salaire;

create or replace view v_heure_montant_total as
select *, get_total_heure(id_pointage_mere) total_heure, get_total_montant(id_pointage_mere) total_montant from v_pointage_mere;

create or replace view v_heure_montant_indemnite_total as
select *, get_indemnite(id_pointage_mere, total_heure) montant_indemnite from v_heure_montant_total;

create or replace view v_total_a_payer as
select *, montant_indemnite+total_montant total_a_payer, total_montant*get_impot()/100 impot from v_heure_montant_indemnite_total;

create or replace view v_total_a_payer_impot as
select *, total_a_payer-impot total_a_payer_impot from v_total_a_payer;

-- stat

create or replace view v_stat_total_a_payer as
select e.*, t.id_pointage_mere, if(t.total_a_payer_impot is null, 0, t.total_a_payer_impot) total_a_payer
from v_employee e left join v_total_a_payer_impot t on t.id_employee=e.id_employee;

-- stat heure
create or replace view v_stat_heure as
select designation, sum(total_heure) total_heure, sum(montant) montant from v_calcul_heure_salaire group by designation;