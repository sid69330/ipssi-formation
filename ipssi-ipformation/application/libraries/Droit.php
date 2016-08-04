<?php

class Droit
{	
	private $ci;
	
	public function __construct()
	{
		$this->ci = $CI = &get_instance();
	}

	/* Fonction qui retourne le droit le plus élevé en fonction de son/ses groupes */
	public function recupDroit($url_page, $id_utilisateur)
	{
		if($url_page == 'ipssi')
			return true;

		$this->ci->db->distinct();
		$this->ci->db->select('D.code_droit');
		$this->ci->db->from('utilisateur U');
		$this->ci->db->join('groupe_utilisateur GU', 'U.id_utilisateur = GU.id_utilisateur');
		$this->ci->db->join('groupe G', 'G.id_groupe = GU.id_groupe');
		$this->ci->db->join('droit_sous_menu_groupe DSMG', 'DSMG.id_groupe = G.id_groupe');
		$this->ci->db->join('sous_menu SM', 'SM.id_sous_menu = DSMG.id_sous_menu');
		$this->ci->db->join('droit D', 'D.id_droit = DSMG.id_droit');

		$this->ci->db->where('U.id_utilisateur', $id_utilisateur);
		$this->ci->db->where('url_sous_menu', $url_page);

		$result = $this->ci->db->get()->result_array();

		$droits = array();
		foreach($result as $r)
		{
			array_push($droits, $r['code_droit']);
		}

		return $droits;
	}

	/* Fonction retourne true si le mot de passe doit être changé : première connexion */
	public function doitModifierMotDePasse($id_utilisateur)
	{
		$this->ci->db->select('mdp_utilisateur_change');
		$this->ci->db->from('utilisateur');
		$this->ci->db->where('id_utilisateur', $id_utilisateur);

		return($this->ci->db->get()->result()[0]->mdp_utilisateur_change == 1);
	}

	public function droitSuffisantLecture($droits, $id_utilisateur_page, $id_utilisateur_connecte)
    {
    	$retour = false;
        
        /* Si tous les droits */
        if(in_array('T', $droits))
            $retour = true;
        elseif((in_array('M', $droits)) || (in_array('V', $droits)))
        {
        	if($id_utilisateur_page == $id_utilisateur_connecte)
        		$retour = true;
        	else
        	{
        		$this->ci->db->distinct();
        		$this->ci->db->select('MAX(G.ordre) as max_utilisateur_connecte, MAX(G2.ordre) as max_utilisateur_page');
				$this->ci->db->from('utilisateur U');
				$this->ci->db->join('groupe_utilisateur GU', 'GU.id_utilisateur = U.id_utilisateur', 'left');
				$this->ci->db->join('groupe G', 'G.id_groupe = GU.id_groupe', 'left');
				$this->ci->db->join('utilisateur U2', 'U2.id_utilisateur <> U.id_utilisateur');
				$this->ci->db->join('groupe_utilisateur GU2', 'GU2.id_utilisateur = U2.id_utilisateur', 'left');
				$this->ci->db->join('groupe G2', 'G2.id_groupe = GU2.id_groupe', 'left');
				$this->ci->db->where('U.id_utilisateur', $id_utilisateur_connecte);
				$this->ci->db->where('U2.id_utilisateur', $id_utilisateur_page);

				$result = $this->ci->db->get()->result()[0];

				if($result->max_utilisateur_connecte >= $result->max_utilisateur_page)
					$retour = true;
				else
					$retour = false;
        	}
        }
        elseif(in_array('P', $droits))
        {
        	if($id_utilisateur_page == $id_utilisateur_connecte)
        		$retour = true;
        	else
        		$retour = false;
        }

        return $retour;
    }
}