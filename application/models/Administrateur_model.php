<?php
class Administrateur_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function connexion($input, $msg = null)
    {
        verifier_index($input, 'nom_administrateur', 'mot_de_passe');
        try {
            $where = array('nom_administrateur' => $input['nom_administrateur'], 'mot_de_passe' => sha1($input['mot_de_passe']));
            $result = $this->db->get_where('administrateur', $where);
            $ret = $result->row_array();
            if (is_null($ret)) {
                throw new Exception($msg);
            }
            $this->se_connecter($ret, admin());
            return $ret;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function is_logged() {
        if(!isset($this->session->connecte)) {
            redirect('Login_Administrateur');
        }
    }

    public function se_connecter($info, $mode)
    {
        $info['mode'] = $mode;
        $this->session->connecte = $info;
    }

    public function se_deconnecter()
    {
        $this->session->sess_destroy();
    }
}
