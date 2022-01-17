<?php

function generer_session($utilisateur_info) {
    date_default_timezone_set('Indian/Antananarivo');
    return sha1(date('Y-m-d H-i-s').$utilisateur_info);
}

function verifier_admin($user) {
    if(isset($user)) {
        return strcmp($user['mode'], admin()) == 0;
    } else {
        throw new Exception("Veuillez vous reconnecter", 300);
    }
}

function admin() {
    return "admin";
}

function employee() {
    return "employee";
}