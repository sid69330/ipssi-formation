<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ressources_humaines_back_model extends CI_Model
{

    //Récupère mes notes de frais personnelles
    public function recupNotesFraisPersonnelles($idUtilisateur)
    {
        $this->db->select('id_note_frais, id_utilisateur,NF.motif_refus, E.libelle_etat as etat,TNF.libelle_type_note_frais as type, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
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
            $this->db->select('id_note_frais, U.id_utilisateur, NF.motif_refus,U.nom_utilisateur, U.prenom_utilisateur,E.id_etat,E.libelle_etat as etat,TNF.libelle_type_note_frais as type, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
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

            $this->db->select('id_note_frais, U.id_utilisateur, NF.motif_refus,U.nom_utilisateur, U.prenom_utilisateur, E.id_etat,E.libelle_etat as etat,TNF.libelle_type_note_frais as type, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
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
            $this->db->select('id_note_frais, U.id_utilisateur, NF.motif_refus,U.nom_utilisateur, U.prenom_utilisateur,E.id_etat,E.libelle_etat as etat,TNF.libelle_type_note_frais as type, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
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

            $this->db->select('id_note_frais, U.id_utilisateur, NF.motif_refus,U.nom_utilisateur, U.prenom_utilisateur, E.id_etat,E.libelle_etat as etat,TNF.libelle_type_note_frais as type, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
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
            $this->db->where('id_etat', 1);
            $this->db->delete('notes_frais');
        }
        else
        {
            $this->db->where('id_note_frais', $id_noteFrais);
            $this->db->where('id_utilisateur', $idUtilisateur);
            $this->db->where('id_etat', 1);
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

     public function recupEtatNoteFrais()
    {
        $this->db->select('id_etat, libelle_etat');
        $this->db->from('etat');

        return $this->db->get()->result();
    }

    public function recupNoteFraisAModifier($id_noteFrais, $idUtilisateur, $droits)
    {
        if(in_array('T', $droits)) 
        {
            $this->db->select('id_note_frais, NF.id_utilisateur,NF.motif_refus,U.nom_utilisateur, U.prenom_utilisateur,E.id_etat,E.id_etat, E.libelle_etat as etat,NF.id_type_note_frais, TNF.libelle_type_note_frais as type, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
            $this->db->from('notes_frais NF');
            $this->db->join('etat E', 'E.id_etat = NF.id_etat');
            $this->db->join('utilisateur U', 'U.id_utilisateur = NF.id_utilisateur');
            $this->db->join('type_notes_frais TNF', 'TNF.id_type_note_frais = NF.id_type_note_frais');
            $this->db->join('type_paiement_notes_frais PNF', 'PNF.id_type_paiement_note_frais = NF.id_type_paiement_note_frais','left');
            $this->db->where('NF.id_note_frais', $id_noteFrais);  

            return $this->db->get()->result()[0];
        }

        elseif(in_array('M', $droits)) 
        {
            $this->db->select('MAX(G.ordre) as maxi');
            $this->db->from('groupe G');
            $this->db->join('groupe_utilisateur GU', 'G.id_groupe = GU.id_groupe');
            $this->db->where('GU.id_utilisateur', $idUtilisateur);

            $ordre = $this->db->get()->result()[0];

            $this->db->select('id_note_frais, U.id_utilisateur, NF.motif_refus,U.nom_utilisateur, U.prenom_utilisateur, E.id_etat,E.libelle_etat as etat,NF.id_type_note_frais, TNF.libelle_type_note_frais as type, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
            $this->db->from('notes_frais NF');
            $this->db->join('etat E', 'E.id_etat = NF.id_etat');
            $this->db->join('type_notes_frais TNF', 'TNF.id_type_note_frais = NF.id_type_note_frais');
            $this->db->join('type_paiement_notes_frais PNF', 'PNF.id_type_paiement_note_frais = NF.id_type_paiement_note_frais','left');
            $this->db->join('utilisateur U', 'U.id_utilisateur = NF.id_utilisateur');
            $this->db->join('groupe_utilisateur GU', 'GU.id_utilisateur = U.id_utilisateur');
            $this->db->join('groupe G', 'G.id_groupe = GU.id_groupe');
            $this->db->where('G.ordre <=',$ordre[0]->maxi);
            $this->db->where('NF.id_note_frais', $id_noteFrais);
            $this->db->order_by('E.id_etat, NF.date_creation_note_frais');

            return $this->db->get()->result()[0];
        }
        elseif(in_array('P', $droits)) 
        {
            $this->db->select('id_note_frais, NF.id_utilisateur,NF.motif_refus,U.nom_utilisateur, U.prenom_utilisateur, E.id_etat,E.libelle_etat as etat,NF.id_type_note_frais TNF.libelle_type_note_frais as type, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
            $this->db->from('notes_frais NF');
            $this->db->join('etat E', 'E.id_etat = NF.id_etat');
            $this->db->join('utilisateur U', 'U.id_utilisateur = NF.id_utilisateur');
            $this->db->join('type_notes_frais TNF', 'TNF.id_type_note_frais = NF.id_type_note_frais');
            $this->db->join('type_paiement_notes_frais PNF', 'PNF.id_type_paiement_note_frais = NF.id_type_paiement_note_frais','left');
            $this->db->where('NF.id_utilisateur', $idUtilisateur);
            $this->db->where('NF.id_note_frais', $id_noteFrais);

            return $this->db->get()->result()[0];
        }

    }

    public function modifier_note_frais($type_note_frais, $description, $date_note, $montant, $trajet, $km_parcouru, $prix_km, $id_note_frais)
    {
        if($type_note_frais <> 9)
        {
            $km_parcouru = null;
            $prix_km = null;
            $trajet = null;
        }

        if($km_parcouru == '')
            $km_parcouru = null;

        if($prix_km == '')
            $prix_km = null;

        if($trajet == '')
            $trajet = null;

        if($date_note != '')
        {
            $tab = explode('-', $date_note);

            if(count($tab) == 3)
                $date_note = $tab[2].'-'.$tab[1].'-'.$tab[0].' 00:00:00';
            else
                $date_note = null;
        }
        else
            $date_note = null;

        
        $data = array
        (
            'id_type_note_frais' => $type_note_frais,
            'description_note_frais' => $description,
            'date_note_frais' => $date_note,
            'montant_note_frais' => $montant,
            'trajet_note_frais' => $trajet,
            'km_parcouru_note_frais' => $km_parcouru,
            'montant_km_note_frais' => $prix_km
        );

        $this->db->where('id_note_frais', $id_note_frais);
        $this->db->update('notes_frais', $data);

        return $this->db->insert_id();

    }

    public function ajouter_note_frais($type_note_frais, $description, $date_note, $montant, $trajet, $km_parcouru, $prix_km, $id_utilisateur)
    {
        if($type_note_frais <> 9)
        {
            $km_parcouru = null;
            $prix_km = null;
            $trajet = null;
        }

        if($km_parcouru == '')
            $km_parcouru = null;

        if($prix_km == '')
            $prix_km = null;

        if($trajet == '')
            $trajet = null;


        if($date_note != '')
        {
            $tab = explode('-', $date_note);

            if(count($tab) == 3)
                $date_note = $tab[2].'-'.$tab[1].'-'.$tab[0].' 00:00:00';
            else
                $date_note = null;
        }
        else
            $date_note = null;

        $data = array
        (
            'id_type_note_frais' => $type_note_frais,
            'description_note_frais' => $description,
            'date_note_frais' => $date_note,
            'montant_note_frais' => $montant,
            'trajet_note_frais' => $trajet,
            'km_parcouru_note_frais' => $km_parcouru,
            'montant_km_note_frais' => $prix_km,
            'id_utilisateur' => $id_utilisateur
        );
        $this->db->insert('notes_frais', $data);

        return $this->db->insert_id();
    }

    public function valider_note_frais($id_note_frais,$etat_note_frais, $motif_refus)
    {

    }

}