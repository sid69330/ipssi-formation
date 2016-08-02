<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compte_back_model extends CI_Model
{
    public function mot_de_passe_actuel_correct($mdp_actuel, $id_utilisateur)
    {
        $this->db->select('id_utilisateur');
        $this->db->from('utilisateur');
        $this->db->where('mdp_utilisateur', $mdp_actuel);
        $this->db->where('id_utilisateur', $id_utilisateur);

        $retour = $this->db->get()->result();

        return(count($retour) == 1);
    }

    public function modifier_mot_de_passe($new_mdp, $id_utilisateur)
    {
        $data = array
        (
            'mdp_utilisateur' => $new_mdp,
            'mdp_utilisateur_change' => 0
        );

        $this->db->set('date_mdp_utilisateur', 'NOW()', FALSE);
        $this->db->where('id_utilisateur', $id_utilisateur);
        $this->db->update('utilisateur', $data);

        return $this->db->affected_rows();
    }
}