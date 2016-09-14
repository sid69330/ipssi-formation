<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ressources_humaines_back_model extends CI_Model
{
    /* -------------------- Gestion des utilisateurs -------------------- */

    /* Page Liste */
    public function liste_utilisateurs($droits, $id_utilisateur)
    {
        /* Si tous les droits */
        if(in_array('T', $droits))
        {
            $this->db->select('id_utilisateur, nom_utilisateur, prenom_utilisateur, supprime');
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
                $this->db->select('U.id_utilisateur, U.nom_utilisateur, U.prenom_utilisateur, supprime');
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
            $this->db->select('id_utilisateur, nom_utilisateur, prenom_utilisateur, supprime');
            $this->db->from('utilisateur');
            $this->db->where('id_utilisateur', $id_utilisateur);

            return $this->db->get()->result();
        }
    }

    /* Retourne vrai si aucune personne que celle passée en paramètre possède l'adresse mail passée en paramètre. Faux sinon */
    public function email_unique_utilisateur($id_utilisateur, $email)
    {
        $this->db->select('id_utilisateur');
        $this->db->from('utilisateur');
        $this->db->where('id_utilisateur <>', $id_utilisateur);
        $this->db->where('mail_utilisateur', $email);

        return(count($this->db->get()->result()) == 0);
    }

    /* Récupère les informations de l'utilisateur passé en paramètre */
    public function recup_infos_utilisateur($id_utilisateur)
    {
        $this->db->select('U.id_utilisateur, U.nom_utilisateur, U.prenom_utilisateur, U.mail_utilisateur, U.telephone_utilisateur, U.date_mdp_utilisateur, U.entreprise_utilisateur, U.photo_profil, U.mdp_utilisateur_change, S.id_sexe, S.raccourci_sexe, DATEDIFF(DATE_ADD(U.date_mdp_utilisateur, INTERVAL 3 MONTH), NOW()) as validite_mdp, supprime');
        $this->db->from('utilisateur U');
        $this->db->join('sexe S', 'S.id_sexe = U.id_sexe');
        $this->db->where('id_utilisateur', $id_utilisateur);

        $result = $this->db->get()->result()[0];

        $this->db->select('G.id_groupe, G.libelle_groupe');
        $this->db->from('groupe_utilisateur GU');
        $this->db->join('groupe G', 'G.id_groupe = GU.id_groupe', 'left');
        $this->db->where('GU.id_utilisateur', $result->id_utilisateur);

        $result->groupes = $this->db->get()->result();

        return $result;
    }

    /* Permet de récupérer les groupes d'un utilisateur passé en paramètre */
    public function recup_groupe_utilisateur($id_utilisateur)
    {
        $retour = array();

        $this->db->select('G.id_groupe');
        $this->db->from('groupe G');
        $this->db->join('groupe_utilisateur GU', 'G.id_groupe = GU.id_groupe', 'left');
        $this->db->where('GU.id_utilisateur', $id_utilisateur);

        $result = $this->db->get()->result();

        foreach($result as $r)
        {
            array_push($retour, $r->id_groupe);
        }

        return $retour;
    }

    /* Retourne true si l'utilisateur existe, false sinon */
    public function utilisateurExiste($id_utilisateur)
    {
        $this->db->select('id_utilisateur');
        $this->db->from('utilisateur');
        $this->db->where('id_utilisateur', $id_utilisateur);

        return(count($this->db->get()->result()) == 1);
    }

    /* Fonction permettant d'ajouter un utilisateur en base de données */
    public function ajouter_utilisateur($sexe, $nom, $prenom, $email, $tel, $mdp, $entreprise, $groupes)
    {
        $data = array(
            'id_sexe' => $sexe,
            'nom_utilisateur' => $nom,
            'prenom_utilisateur' => $prenom,
            'mail_utilisateur' => $email,
            'telephone_utilisateur' => $tel,
            'mdp_utilisateur' => $mdp,
            'entreprise_utilisateur' => $entreprise
        );
        $this->db->insert('utilisateur', $data);

        $insert_id = $this->db->insert_id();

        if($insert_id != '')
        {
            foreach($groupes as $g)
            {
                if($this->groupe_existe($g))
                {
                    $data = array(
                        'id_utilisateur' => $insert_id,
                        'id_groupe' => $g
                    );
                    $this->db->insert('groupe_utilisateur', $data);
                }
            }
        }
        
        return $this->db->affected_rows();
    }

    /* Permet de modifier les informations d'un utilisateur en base de données */
    public function modifier_utilisateur($sexe, $nom, $prenom, $email, $tel, $entreprise, $groupes, $actif, $id_utilisateur)
    {
        $data = array
        (
            'id_sexe' => $sexe,
            'nom_utilisateur' => $nom,
            'prenom_utilisateur' => $prenom,
            'mail_utilisateur' => $email,
            'telephone_utilisateur' => $tel,
            'entreprise_utilisateur' => $entreprise,
            'supprime' => $actif
        );
        $this->db->where('id_utilisateur', $id_utilisateur);
        $this->db->update('utilisateur', $data);

        $this->db->where('id_utilisateur', $id_utilisateur);
        $this->db->delete('groupe_utilisateur');

        foreach($groupes as $g)
        {
            if($this->groupe_existe($g))
            {
                $data = array
                (
                    'id_utilisateur' => $id_utilisateur,
                    'id_groupe' => $g
                );
                $this->db->insert('groupe_utilisateur', $data);
            }
        }
    }

    /* Permet de supprimer un utilisateur en base de données en modifiant le champ supprime en base de données */
    public function supprimer_utilisateur($id_utilisateur)
    {
        $data = array
        (
            'supprime' => 1
        );
        $this->db->where('id_utilisateur', $id_utilisateur);
        $this->db->update('utilisateur', $data);
    }

    /* Retourne vrai si le groupe passé en paramètre existe. Faux sinon */
    public function groupe_existe($id_groupe)
    {
        $this->db->select('id_groupe');
        $this->db->from('groupe');

        return $this->db->count_all_results();
    }

    /* ------------------------------------------------------------------------------------ */

    //Récupère mes notes de frais personnelles
    public function recupNotesFraisPersonnelles($idUtilisateur)
    {
        $this->db->select('id_note_frais, id_utilisateur,NF.motif_refus, E.libelle_etat as etat,TNF.libelle_type_note_frais as type, PNF.id_type_paiement_note_frais, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
        $this->db->from('notes_frais NF');
        $this->db->join('etat E', 'E.id_etat = NF.id_etat');
        $this->db->join('type_notes_frais TNF', 'TNF.id_type_note_frais = NF.id_type_note_frais');
        $this->db->join('type_paiement_notes_frais PNF', 'PNF.id_type_paiement_note_frais = NF.id_type_paiement_note_frais','left');
        $this->db->where('NF.id_utilisateur', $idUtilisateur);

        return $this->db->get()->result();
    }

    Public function recupPaiementNoteFrais()
    {
        $this->db->select('id_type_paiement_note_frais, libelle_paiement_note_frais as paiement');
        $this->db->from('type_paiement_notes_frais');

        return $this->db->get()->result();
    }

    //Récupère les notes de frais des autres utilisateurs 
    public function recupNotesFraisAutres($idUtilisateur, $droits)
    {
        if(in_array('T', $droits)) 
        {
            $this->db->select('id_note_frais, U.id_utilisateur, NF.motif_refus,U.nom_utilisateur, U.prenom_utilisateur,E.id_etat,E.libelle_etat as etat,TNF.libelle_type_note_frais as type, PNF.id_type_paiement_note_frais, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
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

            $this->db->select('id_note_frais, U.id_utilisateur, NF.motif_refus,U.nom_utilisateur, U.prenom_utilisateur, E.id_etat,E.libelle_etat as etat,TNF.libelle_type_note_frais as type, PNF.id_type_paiement_note_frais,PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
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
            $this->db->select('id_note_frais, U.id_utilisateur, NF.motif_refus,U.nom_utilisateur, U.prenom_utilisateur,E.id_etat,E.libelle_etat as etat,TNF.libelle_type_note_frais as type, PNF.id_type_paiement_note_frais,PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
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

            $this->db->select('id_note_frais, U.id_utilisateur, NF.motif_refus,U.nom_utilisateur, U.prenom_utilisateur, E.id_etat,E.libelle_etat as etat,TNF.libelle_type_note_frais as type, PNF.id_type_paiement_note_frais, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
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
            $this->db->select('id_note_frais, NF.id_utilisateur,NF.motif_refus,U.nom_utilisateur, U.prenom_utilisateur,E.id_etat,E.id_etat, E.libelle_etat as etat,NF.id_type_note_frais, TNF.libelle_type_note_frais as type, PNF.id_type_paiement_note_frais, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
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

            $this->db->select('id_note_frais, U.id_utilisateur, NF.motif_refus,U.nom_utilisateur, U.prenom_utilisateur, E.id_etat,E.libelle_etat as etat,NF.id_type_note_frais, TNF.libelle_type_note_frais as type, PNF.id_type_paiement_note_frais, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
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
            $this->db->select('id_note_frais, NF.id_utilisateur,NF.motif_refus,U.nom_utilisateur, U.prenom_utilisateur, E.id_etat,E.libelle_etat as etat,NF.id_type_note_frais TNF.libelle_type_note_frais as type, PNF.id_type_paiement_note_frais, PNF.libelle_paiement_note_frais as paiement, CAST(date_note_frais AS DATE) as date_note_frais, description_note_frais, montant_note_frais, trajet_note_frais, km_parcouru_note_frais, montant_km_note_frais, date_creation_note_frais, date_paiement_note_frais ');
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

    public function valider_note_frais($id_note_frais,$etat_note_frais, $motif_refus, $type_paiement)
    {
        $data = array
        (
            'id_etat' => $etat_note_frais,
            'motif_refus' => $motif_refus,
            'id_type_paiement_note_frais' => $type_paiement
        );
        $this->db->where('id_note_frais', $id_note_frais);
        $this->db->update('notes_frais', $data);

    }

    /* ------------- Postes à pourvoir --------------------*/


    public function recupPostes()
    {
        $this->db->select('P.id_poste, P.titre_poste, P.accroche_poste, P.entreprise_poste, P.description, P.date_debut_poste, P.remuneration_poste, P.niveau_experience, P.id_type_poste, TP.libelle as type');
        $this->db->from('poste_candidature P');
        $this->db->join('type_poste TP', 'P.id_type_poste = TP.id_type_poste');
        $this->db->where('P.supprime', 0);

        return $this->db->get()->result();
    }

    public function recupPoste($id_poste)
    {
        $this->db->select('P.id_poste, P.titre_poste, P.accroche_poste, P.entreprise_poste, P.date_depot, DATE_FORMAT(P.date_debut_poste, "%d-%m-%Y") as date_debut_poste, P.description,P.remuneration_poste, P.niveau_experience, P.id_type_poste, TP.libelle as type');
        $this->db->from('poste_candidature P');
        $this->db->join('type_poste TP', 'P.id_type_poste = TP.id_type_poste');
        $this->db->where('P.id_poste', $id_poste);
        $this->db->where('P.supprime', 0);

        return $this->db->get()->result()[0];
    }

    public function recupTypePoste()
    {
        $this->db->select('id_type_poste, libelle');
        $this->db->from('type_poste');

        return $this->db->get()->result();
    }

    public function modifier_poste($id_poste, $id_type, $titre, $accroche, $entreprise, $description, $date_debut, $remuneration, $niveau)
    {

        $dateMAJ = explode('-',$date_debut);

        $year = $dateMAJ[2];
        $month= $dateMAJ[1];
        $day = $dateMAJ[0];
        $time = ' 00:00:00';

        $dateMAJ = $year .'-'. $month .'-'. $day . $time;


        $data = array
        (
            'id_type_poste' => $id_type,
            'titre_poste' => $titre,
            'accroche_poste' => $accroche,
            'description' => $description,
            'entreprise_poste' => $entreprise,
            'date_debut_poste' => $dateMAJ,
            'remuneration_poste' => $remuneration,
            'niveau_experience' => $niveau
        );

        $this->db->where('id_poste', $id_poste);
        $this->db->update('poste_candidature', $data);
    }

    public function supprimerPoste($id_poste)
    {
        $data = array
        (
            'supprime' => 1
        );

        $this->db->where('id_poste', $id_poste);
        $this->db->update('poste_candidature', $data);
    }

    public function ajouter_poste($type_poste, $titre, $accroche, $entreprise, $description, $remuneration, $date_debut, $niveau_experience)
    {
        $dateMAJ = explode('-',$date_debut);

        $year = $dateMAJ[2];
        $month= $dateMAJ[1];
        $day = $dateMAJ[0];
        $time = ' 00:00:00';

        $dateMAJ = $year .'-'. $month .'-'. $day . $time;

        $data = array
        (
            'id_type_poste' => $type_poste,
            'titre_poste' => $titre,
            'accroche_poste' => $accroche,
            'entreprise_poste' => $entreprise,
            'description' => $description,
            'remuneration_poste' => $remuneration,
            'date_debut_poste' => $dateMAJ,
            'niveau_experience' => $niveau_experience
        );
        $this->db->insert('poste_candidature', $data);

        return $this->db->insert_id();
    }

    /* -----------------------------------------------*/

    /* ------------- Candidatures --------------------*/


    public function recupCandidaturesSpontannees()
    {
        $this->db->select('id_candidature, id_poste_candidature, nom_candidature, prenom_candidature, adresse_candidature, cp_candidature, ville_candidature, pays_candidature, email_candidature, date_naissance, telephone_candidature,S.raccourci_sexe as sexe');
        $this->db->from('candidature C');
        $this->db->join('sexe S','C.id_sexe= S.id_sexe');
        $this->db->where('id_poste_candidature IS NULL');
        $this->db->where('etat', 1);

        return $this->db->get()->result();
    }

    public function recupCandidatures()
    {
        $this->db->select('id_candidature, id_poste_candidature, nom_candidature, prenom_candidature, adresse_candidature, cp_candidature, ville_candidature, pays_candidature, email_candidature, date_naissance, telephone_candidature,S.raccourci_sexe as sexe');
        $this->db->from('candidature C');
        $this->db->join('sexe S','C.id_sexe= S.id_sexe');
        $this->db->where('id_poste_candidature <>', null);
        $this->db->where('etat', 1);

        return $this->db->get()->result();
    }

    public function recupCandidature($id_candidature)
    {
        $this->db->select('id_candidature, id_poste_candidature, nom_candidature, prenom_candidature, adresse_candidature, cp_candidature, ville_candidature, pays_candidature, email_candidature, date_naissance, telephone_candidature,S.raccourci_sexe as sexe');
        $this->db->from('candidature C');
        $this->db->join('sexe S','C.id_sexe= S.id_sexe');
        $this->db->where('id_candidature', $id_candidature);
        $this->db->where('etat', 1);

        return $this->db->get()->result()[0];
    }

    public function supprimerCandidature($id_candidature)
    {
        $data = array
        (
            'etat' => 3
        );

        $this->db->where('id_candidature', $id_candidature);
        $this->db->update('candidature', $data);
    }

    public function recupPosteCandidature($id_candidature)
    {
        $this->db->select('P.id_poste, P.titre_poste, P.accroche_poste, P.entreprise_poste, P.date_depot, DATE_FORMAT(P.date_debut_poste, "%d-%m-%Y") as date_debut_poste, P.description,P.remuneration_poste, P.niveau_experience, P.id_type_poste, TP.libelle as type');
        $this->db->from('poste_candidature P');
        $this->db->join('type_poste TP', 'P.id_type_poste = TP.id_type_poste');
        $this->db->join('candidature C', 'C.id_poste_candidature = P.id_poste');
        $this->db->where('C.id_candidature', $id_candidature);
        $this->db->where('P.supprime', 0);

        return $this->db->get()->result()[0];
    }

    /* -----------------------------------------------*/

    /* ------------- Conges --------------------*/

    public function recupCongesPersonnels($id_utilisateur)
    {
        $this->db->select('C.id_type_conges, C.id_etat, id_conges, id_utilisateur,  DATE_FORMAT(date_debut, "%d-%m-%Y") as date_debut, DATE_FORMAT(date_fin, "%d-%m-%Y") as date_fin, nb_jour, DATE_FORMAT(date_demande, "%d-%m-%Y") as date_demande, TC.libelle as type,E.libelle_etat as etat');
        $this->db->from('conges C');
        $this->db->join('type_conges TC', 'C.id_type_conges = TC.id_type_conges');
        $this->db->join('etat E', 'E.id_etat = C.id_etat');
        $this->db->where('C.id_utilisateur', $id_utilisateur);
        $this->db->order_by('C.id_etat');

        return $this->db->get()->result();
    }

    public function recupConges($id_utilisateur)
    {
        $this->db->select('C.id_type_conges, C.id_etat, id_conges, id_utilisateur,  DATE_FORMAT(date_debut, "%d-%m-%Y") as date_debut, DATE_FORMAT(date_fin, "%d-%m-%Y") as date_fin, nb_jour, DATE_FORMAT(date_demande, "%d-%m-%Y") as date_demande, TC.libelle as type,E.libelle_etat as etat');
        $this->db->from('conges C');
        $this->db->join('type_conges TC', 'C.id_type_conges = TC.id_type_conges');
        $this->db->join('etat E', 'E.id_etat = C.id_etat');
        $this->db->where('C.id_utilisateur <>', $id_utilisateur);
        $this->db->where('C.id_etat',1);

        return $this->db->get()->result();
    }

    public function recupConge($id_conges)
    {
        $this->db->select('C.id_type_conges, C.id_etat, id_conges, id_utilisateur,  DATE_FORMAT(date_debut, "%d-%m-%Y") as date_debut, DATE_FORMAT(date_fin, "%d-%m-%Y") as date_fin, nb_jour, DATE_FORMAT(date_demande, "%d-%m-%Y") as date_demande, TC.libelle as type,E.libelle_etat as etat');
        $this->db->from('conges C');
        $this->db->join('type_conges TC', 'C.id_type_conges = TC.id_type_conges');
        $this->db->join('etat E', 'E.id_etat = C.id_etat');
        $this->db->where('C.id_conges', $id_conges);

        return $this->db->get()->result()[0];
    }


    public function recupEtat()
    {
        $this->db->select('id_etat, libelle_etat');
        $this->db->from('etat');

        return $this->db->get()->result();
    }

    public function recupTypeConges()
    {
        $this->db->select('id_type_conges, libelle');
        $this->db->from('type_conges');

        return $this->db->get()->result();
    }

    public function modifier_conges($id_conges, $type_conges, $etat, $date_debut, $date_fin, $nb_jour)
    {
        $dateMAJ_debut = explode('-',$date_debut);

        $year = $dateMAJ_debut[2];
        $month= $dateMAJ_debut[1];
        $day = $dateMAJ_debut[0];
        $time = ' 00:00:00';

        $dateMAJ_debut = $year .'-'. $month .'-'. $day . $time;

        $dateMAJ_fin = explode('-',$date_fin);

        $year = $dateMAJ_fin[2];
        $month= $dateMAJ_fin[1];
        $day = $dateMAJ_fin[0];
        $time = ' 00:00:00';

        $dateMAJ_fin = $year .'-'. $month .'-'. $day . $time;


        $data = array
        (
            'id_type_conges' => $type_conges,
            'id_etat' => $etat,
            'date_debut' => $dateMAJ_debut,
            'date_fin' => $dateMAJ_fin,
            'nb_jour' => $nb_jour
        );

        $this->db->where('id_conges', $id_conges);
        $this->db->update('conges', $data);
    }

    public function valider_conges($id_conges, $etat)
    {
       
        $data = array
        (
            'id_etat' => $etat
        );

        $this->db->where('id_conges', $id_conges);
        $this->db->update('conges', $data);
    }

    public function supprimer_conges($id_conges)
    {
       
        $this->db->where('id_conges', $id_conges);
        $this->db->delete('conges');
    }

    public function ajouter_conges($type_conges, $date_debut, $date_fin, $nb_jour, $id_utilisateur)
    {

        $dateMAJ_debut = explode('-',$date_debut);

        $year = $dateMAJ_debut[2];
        $month= $dateMAJ_debut[1];
        $day = $dateMAJ_debut[0];
        $time = ' 00:00:00';

        $dateMAJ_debut = $year .'-'. $month .'-'. $day . $time;

        $dateMAJ_fin = explode('-',$date_fin);

        $year = $dateMAJ_fin[2];
        $month= $dateMAJ_fin[1];
        $day = $dateMAJ_fin[0];
        $time = ' 00:00:00';

        $dateMAJ_fin = $year .'-'. $month .'-'. $day . $time;

        $data = array(
            'id_type_conges' => $type_conges,
            'date_debut' => $dateMAJ_debut,
            'date_fin' => $dateMAJ_fin,
            'id_utilisateur' => $id_utilisateur,
            'nb_jour' => $nb_jour
        );
        $this->db->insert('conges', $data);

        $insert_id = $this->db->insert_id();
       
        return $this->db->affected_rows();
    }
    /* ----------------------------------------------*/

}