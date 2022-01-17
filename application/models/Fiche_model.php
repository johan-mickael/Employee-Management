<?php
class Fiche_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pointage_model', 'pointage');
        $this->load->model('Configuration_model', 'conf');
    }
    public function get($id_emp) {
        $ret['detail'] = $this->db->get_where('v_calcul_heure_salaire', array('id_employee' => $id_emp))->result_array();
        $ret['total'] = $this->db->get_where('v_total_a_payer_impot', array('id_employee' => $id_emp))->row_array();
        return $ret;
    }
    public function get_indemnite() {
        $sql = 'select pourcentage from indemnite where id = (select max(id) from indemnite)';
        return $this->db->query($sql)->row_array()['pourcentage'];
    }
    public function _get($id_pm)
    {
        if($id_pm == null) return null;
        $calcul = $this->pointage->get_calcul_heure($id_pm);
        $hj = $this->conf->get_hm($this->conf->hj);
        $hf = $this->conf->get_hm($this->conf->hf);
        $hm30 = $this->conf->get_hm($this->conf->hm30);
        $hm40 = $this->conf->get_hm($this->conf->hm40);
        $hm50 = $this->conf->get_hm($this->conf->hm50);
        $hs30 = $this->conf->get_hs($this->conf->hs30);
        $hs50 = $this->conf->get_hs($this->conf->hs50);

        $ret['designation'] = array('Heures jour', 'Heures nuit', 'Heures Dimanche', 'Heures férié travaillées', 'Heure férié', 'Heure supp 30%', 'Heure supp 50%');
        $ret['total_heure'] = array($calcul['HN'], $calcul['HM30'], $calcul['HM40'], $calcul['HM50'], $calcul['HF'], $calcul['hs30'], $calcul['hs50']);
        $ret['taux'] = array($hj['pourcentage'], $hm30['pourcentage'], $hm40['pourcentage'], $hm50['pourcentage'], $hf['pourcentage'], $hs30['pourcentage'], $hs50['pourcentage']);
        $ret['total_montant'] = 0;
        $this->load->model('Employee', 'emp');
        $indemnite = ($calcul['h_supplementaire'] >= 0) ? $this->emp->get_indemnite($calcul['id_employee']) : 0;
        $ret['indemnite'] = $calcul['salaire'] * $indemnite / 100;
        for ($i = 0; $i < count($ret['taux']); $i++) {
            $ret['taux_horaire'][$i] = $ret['taux'][$i] * $calcul['salaire_heure'] / 100;
            $ret['montant'][$i] = $ret['taux_horaire'][$i] * $ret['total_heure'][$i];
            $ret['total_montant'] += $ret['montant'][$i];
        }
        $ret['total_montant'] += $ret['indemnite'];
        return $ret;
    }

    public function get_last_fiche($id_emp) {
        $last_pointage = $this->pointage->get_last_pointage_employee($id_emp);
        if($last_pointage==null) return;
        $id_pm = $last_pointage['id_pointage_mere'];
        return $this->db->get_where('v_total_a_payer', array('id_pointage_mere' => $id_pm))->row_array();
    }
}
