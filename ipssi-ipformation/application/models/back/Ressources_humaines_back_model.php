<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ressources_humaines_back_model extends CI_Model
{

    //Récupère mes notes de frais personnelles
    public function recupNotesFraisPersonnelles($idUtilisateur)
    {
        $this->db->select('id_note_frais, id_utilisateur,E.libelle_etat as etat,TNF.libelle_type_note_frais as type, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
        $this->db->from('notes_frais NF');
        $this->db->join('etat E', 'E.id_etat = NF.id_etat');
        $this->db->join('type_notes_frais TNF', 'TNF.id_type_note_frais = NF.id_type_note_frais');
        $this->db->join('type_paiement_notes_frais PNF', 'PNF.id_type_paiement_note_frais = NF.id_type_paiement_note_frais','left');
        $this->db->where('NF.id_utilisateur', $idUtilisateur);

        return $this->db->get()->result();
    }

    //Récupère les notes de frais des autres utilisateurs 
    public function recupNotesFraisAutres($idUtilisateur, $droits)
    {
        if(in_array('T', $droits)) 
        {
            $this->db->select('id_note_frais, U.id_utilisateur, U.nom_utilisateur, U.prenom_utilisateur,E.libelle_etat as etat,TNF.libelle_type_note_frais as type, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
            $this->db->from('notes_frais NF');
            $this->db->join('etat E', 'E.id_etat = NF.id_etat');
            $this->db->join('type_notes_frais TNF', 'TNF.id_type_note_frais = NF.id_type_note_frais');
            $this->db->join('type_paiement_notes_frais PNF', 'PNF.id_type_paiement_note_frais = NF.id_type_paiement_note_frais','left');
            $this->db->join('utilisateur U', 'U.id_utilisateur = NF.id_utilisateur');
            $this->db->where('NF.id_utilisateur <>', $idUtilisateur);

            return $this->db->get()->result();
        }
        elseif (in_array('M', $droits) || in_array('V', $droits))
        {

            $this->db->select('MAX(G.ordre) as maxi');
            $this->db->from('groupe G');
            $this->db->join('groupe_utilisateur GU', 'G.id_groupe = GU.id_groupe');
            $this->db->where('GU.id_utilisateur', $idUtilisateur);

            $ordre = $this->db->get()->result();

            $this->db->select('id_note_frais, U.id_utilisateur, U.nom_utilisateur, U.prenom_utilisateur, E.libelle_etat as etat,TNF.libelle_type_note_frais as type, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
            $this->db->from('notes_frais NF');
            $this->db->join('etat E', 'E.id_etat = NF.id_etat');
            $this->db->join('type_notes_frais TNF', 'TNF.id_type_note_frais = NF.id_type_note_frais');
            $this->db->join('type_paiement_notes_frais PNF', 'PNF.id_type_paiement_note_frais = NF.id_type_paiement_note_frais','left');
            $this->db->join('utilisateur U', 'U.id_utilisateur = NF.id_utilisateur');
            $this->db->join('groupe_utilisateur GU', 'GU.id_utilisateur = U.id_utilisateur');
            $this->db->join('groupe G', 'G.id_groupe = GU.id_groupe');
            $this->db->where('NF.id_utilisateur <>', $idUtilisateur);
            $this->db->where('G.ordre <=',$ordre[0]->maxi);
            $this->db->order_by('E.id_etat, NF.date_creation_note_frais');

            return $this->db->get()->result();

        }
        else
            return array();
    }

    public function noteFraisExiste($idNoteFrais)
    {
        $this->db->select('COUNT(*) as nb');
        $this->db->from('notes_frais');
        $this->db->where('id_note_frais',$idNoteFrais);

        return($this->db->get()->result()[0]->nb == 1);
    }

    public function recupNoteFrais($idNoteFrais, $droits,$idUtilisateur)
    {
        if(in_array('T', $droits)) 
        {
            $this->db->select('id_note_frais, U.id_utilisateur, U.nom_utilisateur, U.prenom_utilisateur,E.libelle_etat as etat,TNF.libelle_type_note_frais as type, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
            $this->db->from('notes_frais NF');
            $this->db->join('etat E', 'E.id_etat = NF.id_etat');
            $this->db->join('type_notes_frais TNF', 'TNF.id_type_note_frais = NF.id_type_note_frais');
            $this->db->join('type_paiement_notes_frais PNF', 'PNF.id_type_paiement_note_frais = NF.id_type_paiement_note_frais','left');
            $this->db->join('utilisateur U', 'U.id_utilisateur = NF.id_utilisateur');
            $this->db->where('NF.id_note_frais', $idNoteFrais);

            return $this->db->get()->result()[0];
        }
        elseif (in_array('M', $droits) || in_array('V', $droits))
        {

            $this->db->select('MAX(G.ordre) as maxi');
            $this->db->from('groupe G');
            $this->db->join('groupe_utilisateur GU', 'G.id_groupe = GU.id_groupe');
            $this->db->where('GU.id_utilisateur', $idUtilisateur);

            $ordre = $this->db->get()->result();

            $this->db->select('id_note_frais, U.id_utilisateur, U.nom_utilisateur, U.prenom_utilisateur, E.libelle_etat as etat,TNF.libelle_type_note_frais as type, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
            $this->db->from('notes_frais NF');
            $this->db->join('etat E', 'E.id_etat = NF.id_etat');
            $this->db->join('type_notes_frais TNF', 'TNF.id_type_note_frais = NF.id_type_note_frais');
            $this->db->join('type_paiement_notes_frais PNF', 'PNF.id_type_paiement_note_frais = NF.id_type_paiement_note_frais','left');
            $this->db->join('utilisateur U', 'U.id_utilisateur = NF.id_utilisateur');
            $this->db->join('groupe_utilisateur GU', 'GU.id_utilisateur = U.id_utilisateur');
            $this->db->join('groupe G', 'G.id_groupe = GU.id_groupe');
            $this->db->where('G.ordre <=',$ordre[0]->maxi);
            $this->db->where('NF.id_note_frais', $idNoteFrais);
            $this->db->order_by('E.id_etat, NF.date_creation_note_frais');

            return $this->db->get()->result()[0];

        }
        else
            return array();
    }

    public function supprimerNoteFrais($id_noteFrais, $idUtilisateur, $droits)
    {

        if(in_array('T', $droits) )
        {
            $this->db->where('id_note_frais', $id_noteFrais);
            $this->db->where('id_etat', 0);
            $this->db->delete('notes_frais');
        }
        else
        {
            $this->db->where('id_note_frais', $id_noteFrais);
            $this->db->where('id_utilisateur', $idUtilisateur);
            $this->db->where('id_etat', 0);
            $this->db->delete('notes_frais');
        } 

        return $this->db->affected_rows();
    }

    public function recupTypeNoteFrais()
    {
        $this->db->select('id_type_note_frais, libelle_type_note_frais');
        $this->db->from('type_notes_frais');

        return $this->db->get()->result();
    }

}