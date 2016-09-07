<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Administration_back_model extends CI_Model
{
    /* -------------------- Gestion des droits -------------------- */

    public function majDroits(array $droits)
    {
        foreach($droits as $d)
        {
            $tab = explode('_', $d);

            if(count($tab) == 3)
            {
                $groupe = $tab[0];
                $sous_menu = $tab[1];
                $droit = $tab[2];

                if($droit == 'null')
                    $droit = null;

                $data = array(
                    'id_droit' => $droit
                );
                $this->db->where('id_sous_menu', $sous_menu);
                $this->db->where('id_groupe', $groupe);
                $this->db->update('droit_sous_menu_groupe', $data);
            }
        }
    }

    public function recupDroits($droits, $id_utilisateur)
    {
        $return = array();

        if(in_array('T', $droits))
        {
            $this->db->select('G.id_groupe,  G.libelle_groupe, SM.id_sous_menu, SM.libelle_sous_menu, D.id_droit, D.code_droit');
            $this->db->from('droit_sous_menu_groupe DSMG');
            $this->db->join('droit D', 'D.id_droit = DSMG.id_droit', 'left');
            $this->db->join('groupe G', 'G.id_groupe = DSMG.id_groupe', 'left');
            $this->db->join('sous_menu SM', 'SM.id_sous_menu = DSMG.id_sous_menu', 'left');
            $this->db->order_by('G.id_groupe, SM.id_sous_menu');

            $return = $this->db->get()->result();
        }
        elseif(in_array('M', $droits) || in_array('V', $droits))
        {
            $this->db->select('MAX(G2.ordre) as maxi');
            $this->db->from('groupe G2');
            $this->db->join('groupe_utilisateur GU2', 'G2.id_groupe = GU2.id_groupe');
            $this->db->where('GU2.id_utilisateur', $id_utilisateur);

            $ordre = $this->db->get()->result();

            if(isset($ordre[0]->maxi))
            {
                $this->db->select('G.id_groupe,  G.libelle_groupe, SM.id_sous_menu, SM.libelle_sous_menu, D.id_droit, D.code_droit');
                $this->db->from('droit_sous_menu_groupe DSMG');
                $this->db->join('droit D', 'D.id_droit = DSMG.id_droit', 'left');
                $this->db->join('groupe G', 'G.id_groupe = DSMG.id_groupe', 'left');
                $this->db->join('sous_menu SM', 'SM.id_sous_menu = DSMG.id_sous_menu', 'left');
                $this->db->where('G.ordre <= ', $ordre[0]->maxi);
                $this->db->order_by('G.id_groupe, SM.id_sous_menu');

                $return = $this->db->get()->result();
            }
            
            
        }
        elseif(in_array('P', $droits))
        {

        }

        return $return;
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