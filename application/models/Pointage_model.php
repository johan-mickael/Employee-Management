<?php
class Pointage_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->nb_jour_semaine = 7;
        $this->nb_heure_jour = 17;
        $this->nb_heure_nuit = 7;
        // $this->admin->is_logged();
    }

    public function get_pm($id) {
        return $this->db->get_where('pointage_mere', array('id_pointage_mere' => $id))->row_array();
    }

    public function get_last_pointage_employee($id_emp) {
        $sql = "select max(id_pointage_mere) id_pointage_mere from pointage_mere  where id_employee=$id_emp";
        $id_pm = $this->db->query($sql)->row_array()['id_pointage_mere'];
        return $this->get_pm($id_pm);
    }

    public function get_employee_pointage($id_pm) {
        $id = $this->get_pm($id_pm)['id_employee'];
        $this->load->model('Employee_model', 'emp');
        return $this->emp->get_by_id($id);
    }

    public function get_calcul_heure($id_emp) {
        return $this->db->get_where('v_calcul_heure', array('id_employee' => $id_emp))->row_array();
    }

    public function inserer_pointage_mere($id_employee)
    {
        $this->delete_pointage_mere($id_employee);
        debug($this->db->last_query());
        $sql = "insert into pointage_mere values (null, $id_employee, current_timestamp)";
        return $this->db->query($sql);
    }

    public function delete_pointage_mere($id_employee) {
        $id_pm = $this->get_pm_by_emp($id_employee)['id_pointage_mere'];
        debug($this->db->last_query());
        $this->delete_pointage_fille($id_pm);
        debug($this->db->last_query());
        $sql = "delete from pointage_mere where id_pointage_mere = $id_pm";
        return $this->db->query($sql);
    }

    public function delete_pointage_fille($id_pm) {
        $sql = "delete from pointage_fille where id_pointage_mere=$id_pm";
        return $this->db->query($sql);
    }

    public function get_pm_by_emp($id_emp) {
        return $this->db->get_where('pointage_mere', array('id_employee' => $id_emp))->row_array();
    }

    public function inserer_pointage($input)
    {
        $this->verifier_pointage($input);
        $this->inserer_pointage_mere($input['id_employee']);
        $id_pointage_mere = $this->base->get_max_id('id_pointage_mere', 'pointage_mere');
        $data = array();
        for ($i = 0; $i < $this->nb_jour_semaine; $i++) {
            $ferie = (isset($input['ferie' . $i])) ? true : false;
            $data[] = array(
                'id_pointage_mere' => $id_pointage_mere,
                'jour' => $i + 1,
                'h_jour' => $input['h_jour' . $i],
                'h_nuit' => $input['h_nuit' . $i],
                'h_ferie' => $input['h_ferie' . $i]
            );
        }
        $this->db->insert_batch('pointage_fille', $data);
        return $id_pointage_mere;
    }

    public function verifier_heure($h)
    {
        if (!is_numeric($h)) {
            return false;
        }
        if ($h < 0 || $h > 24) {
            return false;
        }
        return true;
    }

    public function verifier_heure_jour_nuit($j, $n)
    {
        if(!$this->verifier_heure($j)) {
            throw new Exception('Heure (jour) invalide.');
        }
        if(!$this->verifier_heure($n)) {
            throw new Exception('Heure (nuit) invalide.');
        }
        if ($j > $this->nb_heure_jour) {
            throw new Exception("Heure (jour) incorrect.");
        }
        if ($n > $this->nb_heure_nuit) {
            throw new Exception("Heure (nuit) incorrect.");
        }
        return true;
    }

    public function verifier_heure_ferie($f) {
        if(!$this->verifier_heure($f)) {
            throw new Exception('Heure (ferie) invalide.');
        }
        return true;
    }

    public function verifier_pointage($input)
    {
        for ($i = 0; $i < $this->nb_jour_semaine; $i++) {
            $this->verifier_heure_jour_nuit($input['h_jour' . $i], $input['h_nuit' . $i]);
            $this->verifier_heure_ferie($input['h_ferie'.$i]);
        }
        return true;
    }
}
