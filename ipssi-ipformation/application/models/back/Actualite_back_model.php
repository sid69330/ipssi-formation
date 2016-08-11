<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actualite_back_model extends CI_Model
{
    public function liste_actualite($droits, $id_utilisateur)
    {
        /* Si tous les droits */
        if(in_array('T', $droits))
        {
            $this->db->select('A.id_actualite, A.id_utilisateur, A.titre_actualite, A.texte_actualite, DATE_FORMAT(A.date_actualite, "%d/%m/%Y") as date_actualite, A.url_photo_actualite, DATE_FORMAT(A.date_validite_actualite, "%d/%m/%Y") as date_validite_actualite, CASE WHEN A.date_validite_actualite > NOW() THEN 1 ELSE 0 END as valide, U.nom_utilisateur, U.prenom_utilisateur');
            $this->db->from('actualite A');
            $this->db->join('utilisateur U', 'U.id_utilisateur = A.id_utilisateur');

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
                $this->db->select('A.id_actualite, A.id_utilisateur, A.titre_actualite, A.texte_actualite, DATE_FORMAT(A.date_actualite, "%d/%m/%Y") as date_actualite, A.url_photo_actualite, DATE_FORMAT(A.date_validite_actualite, "%d/%m/%Y") as date_validite_actualite, CASE WHEN A.date_validite_actualite > NOW() THEN 0 ELSE 1 END as valide, U.nom_utilisateur, U.prenom_utilisateur');
                $this->db->from('actualite A');
                $this->db->join('utilisateur U', 'U.id_utilisateur = A.id_utilisateur');
                $this->db->join('groupe_utilisateur GU', 'A.id_utilisateur = GU.id_utilisateur');
                $this->db->join('groupe G', 'G.id_groupe = GU.id_groupe');
                $this->db->where('ordre <=', $ordre[0]->maxi);

                return $this->db->get()->result();
            }
        }
        /* Si droit vue et modification personnelle */
        elseif(in_array('P', $droits))
        {
            $this->db->select('A.id_actualite, A.id_utilisateur, A.titre_actualite, A.texte_actualite, DATE_FORMAT(A.date_actualite, "%d/%m/%Y") as date_actualite, A.url_photo_actualite, DATE_FORMAT(A.date_validite_actualite, "%d/%m/%Y") as date_validite_actualite, CASE WHEN A.date_validite_actualite > NOW() THEN 0 ELSE 1 END as valide, U.nom_utilisateur, U.prenom_utilisateur');
            $this->db->from('actualite A');
            $this->db->join('utilisateur U', 'U.id_utilisateur = A.id_utilisateur');
            $this->db->where('A.id_utilisateur', $id_utilisateur);

            return $this->db->get()->result();
        }
    }
}