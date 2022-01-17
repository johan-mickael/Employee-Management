<?php

function verifier_index($array, ...$index) {
    foreach($index as $index_item) {
        if(!isset($array[$index_item])) {
            throw new Exception("Erreur du serveur interne", 500);
        }
    }
    return true;
}