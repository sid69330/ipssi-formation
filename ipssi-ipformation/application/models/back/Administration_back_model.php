<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administration_back_model extends CI_Model
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
        $this->db->select('U.id_utilisateur, U.nom_utilisateur, U.prenom_utilisateur, U.mail_utilisateur, U.telephone_utilisateur, U.date_mdp_utilisateur, U.entreprise_utilisateur, U.photo_profil, U.mdp_utilisateur_change, S.id_sexe, S.raccourci_sexe, DATEDIFF(DATE_ADD(U.date_mdp_utilisateur, INTERVAL 3 MONTH), NOW()) as validite_mdp');
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
    public function modifier_utilisateur($sexe, $nom, $prenom, $email, $tel, $entreprise, $groupes, $id_utilisateur)
    {
        $data = array
        (
            'id_sexe' => $sexe,
            'nom_utilisateur' => $nom,
            'prenom_utilisateur' => $prenom,
            'mail_utilisateur' => $email,
            'telephone_utilisateur' => $tel,
            'entreprise_utilisateur' => $entreprise
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

    /* -------------------- Rédaction des pages -------------------- */

    /* Permet de récupérer la liste des pages pouvant être rédigée */
    public function recup_redaction_pages()
    {
        $this->db->select('M.id_menu, M.libelle_menu, M.url_menu, SM.id_sous_menu, SM.libelle_sous_menu, SM.url_sous_menu');
        $this->db->from('menu M');
        $this->db->join('sous_menu SM', 'SM.id_menu = M.id_menu', 'left');
        $this->db->where('front', 1);

        return $this->db->get()->result();
    }

    public function menu_sous_menu_existe($libelle_menu, $libelle_sous_menu)
    {
        $retour = false; 

        $this->db->select('M.id_menu, id_sous_menu');
        $this->db->from('menu M');
        $this->db->join('sous_menu SM', 'SM.id_menu = M.id_menu', 'left');
        $this->db->where('M.url_menu', $libelle_menu);

        if($libelle_sous_menu == '')
            $this->db->where('SM.url_sous_menu', null);
        else
            $this->db->where('SM.url_sous_menu', $libelle_sous_menu);

        $result = $this->db->get()->result();

        if(count($result) == 0)
            $retour = false;
        else
        {
            if($libelle_sous_menu != '')
                $retour = true;
            elseif($libelle_menu == 'accueil')
                $retour = true;
        }

        return $retour;
    }

    public function recup_detail_redaction_pages($libelle_menu, $libelle_sous_menu)
    {
        $this->db->select('P.texte_page_contenu, M.url_menu, M.id_menu, SM.url_sous_menu, SM.id_sous_menu');
        $this->db->from('menu M');
        $this->db->join('sous_menu SM', 'SM.id_menu = M.id_menu', 'left');

        if($libelle_sous_menu == '')
            $this->db->join('page_contenu P', 'M.id_menu = P.id_menu', 'left');
        else
            $this->db->join('page_contenu P', 'SM.id_sous_menu = P.id_sous_menu AND M.id_menu = P.id_menu', 'left');
        
        $this->db->where('M.url_menu', $libelle_menu);

        if($libelle_sous_menu == '')
            $this->db->where('SM.url_sous_menu', null);
        else
            $this->db->where('SM.url_sous_menu', $libelle_sous_menu);

        return $this->db->get()->result()[0];
    }

    public function modifier_contenu_page($id_menu, $id_sous_menu, $contenu)
    {
        $this->db->where('id_menu', $id_menu);
        $this->db->where('id_sous_menu', $id_sous_menu);
        $this->db->delete('page_contenu');

        $data = array
        (
            'id_menu' => $id_menu,
            'id_sous_menu' => $id_sous_menu,
            'texte_page_contenu' => $contenu
        );
        $this->db->insert('page_contenu', $data);
    }
}