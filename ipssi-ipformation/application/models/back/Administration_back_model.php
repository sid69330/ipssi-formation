<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administration_back_model extends CI_Model
{
    /* Page Liste */
    public function liste_utilisateurs($droits, $id_utilisateur)
    {
        /* Si tous les droits */
        if(in_array('T', $droits))
        {
            $this->db->select('id_utilisateur, nom_utilisateur, prenom_utilisateur');
            $this->db->from('utilisateur');

            return $this->db->get()->result();
        }
        /* Si droits N et N- */
        elseif(in_array('M', $droits) || in_array('V', $droits))
        {
            $this->db->select('MAX(G2.ordre) as maxi');
            $this->db->from('groupe G2');
            $this->db->join('groupe_utilisateur GU2', 'G2.id_groupe = GU2.id_groupe');
            $this->db->where('GU2.id_utilisateur', $id_utilisateur);
            
            $ordre = $this->db->get()->result();

            if(isset($ordre[0]->maxi))
            {
                $this->db->distinct();
                $this->db->select('U.id_utilisateur, U.nom_utilisateur, U.prenom_utilisateur');
                $this->db->from('utilisateur U');
                $this->db->join('groupe_utilisateur GU', 'U.id_utilisateur = GU.id_utilisateur');
                $this->db->join('groupe G', 'G.id_groupe = GU.id_groupe');
                $this->db->where('ordre <=', $ordre[0]->maxi);

                return $this->db->get()->result();
            }
        }
        /* Si droit vue et modification personnelle */
        elseif(in_array('P', $droits))
        {
            $this->db->select('id_utilisateur, nom_utilisateur, prenom_utilisateur');
            $this->db->from('utilisateur');
            $this->db->where('id_utilisateur', $id_utilisateur);

            return $this->db->get()->result();
        }
    }

    public function recup_infos_utilisateur($id_utilisateur)
    {
        $this->db->select('U.id_utilisateur, U.nom_utilisateur, U.prenom_utilisateur, U.mail_utilisateur, U.telephone_utilisateur, U.date_mdp_utilisateur, U.entreprise_utilisateur, U.photo_profil, U.mdp_utilisateur_change, S.raccourci_sexe, DATEDIFF(DATE_ADD(U.date_mdp_utilisateur, INTERVAL 3 MONTH), NOW()) as validite_mdp');
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

    /* Retourne true si l'utilisateur existe, false sinon */
    public function utilisateurExiste($id_utilisateur)
    {
        $this->db->select('id_utilisateur');
        $this->db->from('utilisateur');
        $this->db->where('id_utilisateur', $id_utilisateur);

        return(count($this->db->get()->result()) == 1);
    }
}