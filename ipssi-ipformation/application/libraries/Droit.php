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

		return $this->ci->db->get()->result_array();
	}

	/* Fonction retourne true si le mot de passe doit être changé : première connexion */
	public function doitModifierMotDePasse($id_utilisateur)
	{
		$this->ci->db->select('mdp_utilisateur_change');
		$this->ci->db->from('utilisateur');
		$this->ci->db->where('id_utilisateur', $id_utilisateur);

		return($this->ci->db->get()->result()[0]->mdp_utilisateur_change == 1);
	}
}