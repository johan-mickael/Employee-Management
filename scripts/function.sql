delimiter //
CREATE FUNCTION get_hs30(h_supp double) RETURNS double
BEGIN
    declare ret double default 0;
    Declare hmax double default 0;

    if h_supp <= 0 then return 0;end if;

    Select h_max into hmax from h_supplementaire where id_h_supplementaire=1;
    if hmax <= h_supp then set ret = hmax;
    else set ret = h_supp;
    end if;
    RETURN ret;
END;//
delimiter ;

delimiter //
CREATE FUNCTION get_hs50(h_supp double) RETURNS double
BEGIN
    declare ret double default 0;
    declare hmax double default 0;
    declare hs30 double default 0;

    if h_supp <= 0 then return 0; end if;

    set hs30 = (select get_hs30(h_supp));
    set h_supp = h_supp - hs30;

    Select h_max into hmax from h_supplementaire where id_h_supplementaire=2;
    set hmax = hmax-hs30;

    if hmax <= h_supp then set ret = hmax;
    else set ret = h_supp; end if;
    RETURN ret;
END;//
delimiter ;

drop function get_taux_hm;
delimiter //
CREATE FUNCTION get_taux_hm(id int) RETURNS double
BEGIN
    declare ret double default 0;

    Select pourcentage into ret from h_majoree where id_h_majoree=id;

    RETURN ret;
END;//
delimiter ;

drop function get_taux_hs;
delimiter //
CREATE FUNCTION get_taux_hs(id int) RETURNS double
BEGIN
    declare ret double default 0;

    Select pourcentage into ret from h_supplementaire where id_h_supplementaire=id;

    RETURN ret;
END;//
delimiter ;

drop function get_total_heure;
delimiter //
CREATE FUNCTION get_total_heure(id_pm int) RETURNS double
BEGIN
    declare ret double default 0;

    Select sum(total_heure) into ret from v_calcul_heure_salaire where id_pointage_mere=id_pm and designation != 'HS50' and designation != 'HS30';

    RETURN ret;
END;//
delimiter ;

drop function get_total_montant;
delimiter //
CREATE FUNCTION get_total_montant(id_pm int) RETURNS double
BEGIN
    declare ret double default 0;

    Select sum(montant) into ret from v_calcul_heure_salaire where id_pointage_mere=id_pm;

    RETURN ret;
END;//
delimiter ;

drop function get_indemnite;
delimiter //
CREATE FUNCTION get_indemnite(id_pm int, total_heure double) RETURNS double
BEGIN
    declare _heure double default 0;
    declare _salaire double default 0;
    declare _indemnite double default 0;

    select heure, salaire, indemnite into _heure, _salaire, _indemnite from v_pointage_mere where id_pointage_mere=id_pm;

    if total_heure<_heure then return 0;
    else return _salaire*_indemnite/100;
    end if;
END;//
delimiter ;

delimiter //
CREATE FUNCTION get_impot() RETURNS double
BEGIN
    declare ret double default 0;

    Select pourcentage into ret from impot;

    RETURN ret;
END;//
delimiter ;