<?php
class Categorie_model extends CI_Model {

    public function get_all() {
        return $this->base->get('categorie');
    }

    public function get_by_id($id) {
        return $this->db->get_where('categorie', array('id_categorie' => $id))->row_array();
    }

    public function modifier($input) {
        $sql = "update categorie set nom_categorie='%s', heure='%d', salaire='%d', indemnite='%d' ";
        $sql .= "where id_categorie = %s";
        $sql = sprintf($sql, $input['nom'], $input['heure'], $input['salaire'], $input['indemnite'], $input['id_categorie']);
        return $this->db->query($sql);
    }

}