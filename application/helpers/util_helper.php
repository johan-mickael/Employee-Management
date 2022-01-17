<?php

function creer_button($href = "#", $class = "btn", $text = "button")
{
    $ret = "<a href='{$href}'>";
    $ret .= "<button class='{$class}'>{$text}</button></a>";
    return $ret;
}

function creer_buttons($buttons)
{
    $ret = "";
    foreach ($buttons as $button) {
        $ret .= $button;
    }
    return $ret;
}

function convertir_semaine($sem)
{
    $jour = substr($sem / 7, 0, 3);
    $mois = $sem / 4;
    $mois = substr($mois, 0, 3);
    $annee = $mois / 12;
    $annee = substr($annee, 0, 3);
    if ($sem < 1) {
        return $jour . " j";
    }
    if ($mois < 1) {
        return $sem . "s";
    }
    if ($mois >= 1 && $mois < 12) {
        return ($mois) . " m";
    }
    return $annee . " a";
}

function get_age($birthday)
{
    list($year, $month, $day) = explode("-", $birthday);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($day_diff < 0 || $month_diff < 0)
        $year_diff--;
    return $year_diff;
}

function month_diff($date1, $date2)
{
    $ts1 = strtotime($date1);
    $ts2 = strtotime($date2);

    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

    $day1 = date('d', $ts1);
    $day2 = date('d', $ts2);

    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
    if($day1 > $day2) $diff--;
    return $diff;
}

function est_majeur($birthday)
{
    return get_age($birthday) > 17;
}

function date_add_month($month, $date)
{
    $effectiveDate = strtotime("+{$month} months", strtotime($date));
    return date("Y-m-d", $effectiveDate);
}

function date_add_year($year, $date)
{
    $effectiveDate = strtotime("+{$year} years", strtotime($date));
    return date("Y-m-d", $effectiveDate);
}

function verifier_taille($min_size, $string)
{
    return strlen($string) >= $min_size;
}

function verifier_nb_minimum($min, $number)
{
    return $number >= $min;
}

function est_champ_vide($input)
{
    return strcmp($input, "") == 0;
}

function jours_de_la_semaine() {
    return array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
}
