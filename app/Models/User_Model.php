<?php
class User_model extends CI_Model {
    public function verify_user($username, $password) {
        $query = $this->db->get_where('utilisateurs', array('nom_utilisateur' => $username, 'mot_de_passe' => $password));
        return $query->row_array();
    }
}
?>
