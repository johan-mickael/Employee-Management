<?php
class Employee_model extends CI_Model
{
    function __construct()
    {
        $this->prefixe = 'EMP';
        $this->table = 'v_employee';
        $this->where = array('actif' => true);
        $this->column_order = array(null, 'matricule', 'nom_employee', null, 'age', 'dt_embauche', 'dt_fin_contrat');
        $this->column_search = array('matricule', 'nom_employee', 'categorie_emp', 'age');
        $this->order = array('nom_employee' => 'asc');
    }

    public function get_indemnite($id) {
        $this->load->model('Categorie_model', 'cat');
		$emp = $this->get_by_id($id);
        $cat = $this->cat->get_by_id($emp['id_categorie']);
        return $cat['indemnite'];
	}

    public function get_all()
    {
        return $this->db->get_where('v_Employee', array('actif' => 1))->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('v_Employee', array('id_employee' => $id))->row_array();
    }

    public function modifier($input)
    {
        $this->verifier_input($input);
        $sql = "update employee set nom_employee='%s', categorie_emp='%s', dt_naissance='%s', dt_embauche='%s', dt_fin_contrat='%s', mot_de_passe='%s' ";
        $sql .= "where id_employee = %s";
        $sql = sprintf($sql, $input['nom'], $input['categorie'], $input['naissance'], $input['embauche'], date_add_month($input['contrat'], $input['embauche']), $input['mot_de_passe'], $input['id_employee']);
        return $this->db->query($sql);
    }

    public function supprimer($id)
    {
        $sql = "update employee set actif = false where id_employee = {$id}";
        return $this->db->query($sql);
    }

    public function ajouter($input)
    {
        $this->verifier_input($input);
        $sql = "insert into employee (nom_employee, matricule, dt_naissance, dt_embauche, dt_fin_contrat, categorie_emp, mot_de_passe) ";
        $sql .= "values ('%s', '%s', '%s', '%s','%s', '%s', '%s')";
        $matricule = $this->emp->generer_matricule($this->base->get_last_id('employee'));
        $sql = sprintf($sql, $input['nom'], $matricule, $input['naissance'], $input['embauche'], date_add_month($input['contrat'], $input['embauche']), $input['categorie'], $input['mot_de_passe']);
        return $this->db->query($sql);
    }

    public function get_all_actifs()
    {
        return $this->model->base->get_where('v_employee', array('actif' => '1'));
    }

    public function verifier_input($input)
    {
        $this->verifier_nom($input);
        $this->verifier_naissance($input);
        $this->verifier_embauche($input);
        // $this->verifier_contrat($input);
        $this->verifier_mdp($input);
    }

    public function verifier_nom($input)
    {
        if (!verifier_taille(2, $input['nom'])) {
            throw new Exception('Nom invalide.');
        }
    }

    public function verifier_naissance($input)
    {
        if (est_champ_vide($input['naissance'])) {
            throw new Exception('Date de naissance invalide.');
        }
        if (!est_majeur($input['naissance'])) {
            throw new Exception('Impossible de créer un employé mineur.');
        }
    }

    public function verifier_embauche($input)
    {
        if (est_champ_vide($input['embauche'])) {
            throw new Exception('Date d\'embauche invalide.');
        }
        $embauche_min = date_add_year(18, $input['naissance']);
        if ($input['embauche'] < $embauche_min) {
            throw new Exception('Impossible d\'embaucher un employé mineur.');
        }
    }

    public function verifier_contrat($input)
    {
        if (intval($input['contrat']) < 1) {
            throw new Exception('Durée de contrat invalide');
        }
    }

    public function verifier_mdp($input)
    {
        if (!verifier_taille(1, $input['mot_de_passe'])) {
            throw new Exception('Mot de passe invalide');
        }
    }

    public function generer_matricule($id)
    {
        $ret = $this->prefixe;
        $max_size = 4;
        $size = strlen($id);
        $zero = $max_size - $size;
        for ($i = 0; $i < $zero; $i++) {
            $ret .= '0';
        }
        return $ret . $id;
    }
    // DATATABLE SERVER-SIDE

    public function countAll()
    {
        $this->db->from($this->table);
        $this->db->where($this->where);
        return $this->db->count_all_results();
    }
    public function getRows($postData)
    {
        $this->_get_datatables_query($postData);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        debug($this->db->last_query());
        $ret = $query->result_array();
        for ($i = 0; $i < count($ret); $i++) {
            $ret[$i]['numero'] = $i + 1;
        }
        return $ret;
    }
    public function countFiltered($postData)
    {
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    private function _get_datatables_query($postData)
    {
        $this->db->from($this->table);
        $this->db->where($this->where);

        $input_multicritere = $this->get_input_multicritere($postData);
        $i = 0;
        if (isset($postData['search']) && strcmp($postData['search']['value'], "") != 0) {
            foreach ($this->column_search as $item) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                } else {
                    $this->db->or_like($item, $postData['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }
                $i++;
            }
        } else if (count($input_multicritere) > 0) {
            foreach ($input_multicritere as $critere) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($critere['colonne'], $critere['valeur']);
                } else {
                    $this->db->like($critere['colonne'], $critere['valeur']);
                }
                if (count($input_multicritere) - 1 == $i) {
                    $this->db->group_end();
                }
                $i++;
            }
        }

        if (isset($postData['order'])) {
            $indice_colonne = $postData['order']['0']['column'];
            $direction = $postData['order']['0']['dir'];
            $this->db->order_by($this->column_order[$indice_colonne], $direction);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_input_multicritere($post_data)
    {
        $ret = array();
        if (!isset($post_data['columns'])) return null;
        foreach ($post_data['columns'] as $colonne) {
            if (strcmp($colonne['search']['value'], "") != 0) {
                $col['colonne'] = $colonne['data'];
                $col['valeur'] = $colonne['search']['value'];
                array_push($ret, $col);
            }
        }
        return $ret;
    }
}
