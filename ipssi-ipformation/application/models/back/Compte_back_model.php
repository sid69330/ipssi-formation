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

    public function maj_infos_utilisateur($id_utilisateur, $tel)
    {
        $data = array
        (
            'telephone_utilisateur' => $tel
        );

        $this->db->where('id_utilisateur', $id_utilisateur);
        $this->db->update('utilisateur', $data);

        return $this->db->affected_rows();
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

    public function majPhoto($nomFichier, $id_utilisateur)
    {
        $data = array
        (
            'photo_profil' => $nomFichier
        );
        $this->db->where('id_utilisateur', $id_utilisateur);
        $this->db->update('utilisateur', $data);

        return $this->db->affected_rows();
    }

    public function recupInfosUtilisateur($id_utilisateur)
    {
        $this->db->select('U.id_utilisateur, U.mail_utilisateur, U.telephone_utilisateur, U.date_mdp_utilisateur, U.entreprise_utilisateur, U.photo_profil, S.raccourci_sexe, DATEDIFF(DATE_ADD(U.date_mdp_utilisateur, INTERVAL 3 MONTH), NOW()) as validite_mdp');
        $this->db->from('utilisateur U');
        $this->db->join('sexe S', 'S.id_sexe = U.id_sexe');
        $this->db->where('id_utilisateur', $id_utilisateur);

        $result = $this->db->get()->result()[0];

        $this->db->select('G.libelle_groupe');
        $this->db->from('groupe_utilisateur GU');
        $this->db->join('groupe G', 'G.id_groupe = GU.id_groupe', 'left');
        $this->db->where('GU.id_utilisateur', $result->id_utilisateur);

        $result->groupes = $this->db->get()->result();

        return $result;
    }
}