<?php

class Menu
{	
	//Attributs
	private $id_menu;
	private $libelle_menu;
	private $nb_sous_menu;
	private $lien_menu;
	private $sous_menus; //Tableau
	
	//Accesseurs
	public function id_menu() { return $this->id_menu; }
	public function libelle_menu() { return $this->libelle_menu; }
	public function lien_menu() { return $this->lien_menu; }
	public function nb_sous_menu() { return $this->nb_sous_menu; }
	public function sous_menus() { return $this->sous_menus; }
	
	//Constructeurs
	public function __construct($id_menu = '', $libelle_menu = '', $lien = '', $nb_sous_menu = '')
    {
		$this->id_menu = $id_menu;
		$this->libelle_menu = $libelle_menu;
		$this->nb_sous_menu = $nb_sous_menu;
		$this->lien_menu = $lien;
		$this->sous_menus = '';
    }

	/* ----------------------------------------------- Front ----------------------------------------------- */

	//Fonction permettant de récupérer les menus en base de données accompagnés de leurs sous-menus.
	//IN : /
	//OUT : tableau d'objet Menu
	public function recupMenu()
	{
		$CI =& get_instance();
		$menus = array();
		
		$CI->db->select('menu.id_menu, libelle_menu, url_menu, count(id_sous_menu) as nb_sous_menu', false);
		$CI->db->from('menu');
		$CI->db->join('sous_menu SM', 'menu.id_menu = SM.id_menu', 'left');
		$CI->db->where('front', 1);
		$CI->db->group_by('libelle_menu');
		$CI->db->order_by('tri_menu');
		$result = $CI->db->get()->result();
		
		foreach($result as $r)
		{
			$menu = new Menu($r->id_menu, $r->libelle_menu, $r->url_menu, $r->nb_sous_menu);

			if($r->nb_sous_menu > 0)
			{
				$sous_menus = $this->recupSousMenu($r->id_menu);
				$menu->sous_menus = $sous_menus;
			}
			array_push($menus, $menu);
		}
		return $menus;
	}
	
	//Fonction permettant de récupérer les sous-menus liés à un menu
	//IN : idMenu
	//OUT : tableau du résultat de la requête
	public function recupSousMenu($idMenu)
	{
		$CI =& get_instance();
		$CI->db->select('id_sous_menu, libelle_sous_menu, url_sous_menu');
		$CI->db->from('sous_menu');
		$CI->db->where('id_menu', $idMenu);
		return $CI->db->get()->result();
	}
	
	public function recupSousSousMenu($id_sous_menu)
	{
		$CI =& get_instance();
		$CI->db->select('id_sous_sous_menu, libelle_sous_sous_menu');
		$CI->db->from('sous_sous_menu SSM');
		$CI->db->join('sous_menu SM', 'SSM.id_sous_menu = SM.id_sous_menu');
		$CI->db->where('SM.id_sous_menu', $id_sous_menu);

		return $CI->db->get()->result();
	}

	/* ----------------------------------------------- Back ----------------------------------------------- */

	public function recupGroupe($id_utilisateur)
	{
		$result = array();

		$CI =& get_instance();
		$CI->db->select('id_groupe');
		$CI->db->from('groupe_utilisateur');
		$CI->db->where('id_utilisateur', $id_utilisateur);

		$groupes = $CI->db->get()->result();

		foreach($groupes as $g)
		{
			array_push($result, $g->id_groupe);
		}

		return $result;
	}

	public function recupMenuBack($id_utilisateur)
	{
		$CI =& get_instance();
		$menus = array();

		$groupes = $this->recupGroupe($id_utilisateur);

		if(count($groupes) > 0)
		{
			$CI->db->select('menu.id_menu, libelle_menu, url_menu', false);
			$CI->db->from('menu');
			$CI->db->join('sous_menu SM', 'menu.id_menu = SM.id_menu');
			$CI->db->join('droit_sous_menu_groupe D', 'D.id_sous_menu = SM.id_sous_menu');
			$CI->db->where('front', 0);
			$CI->db->where_in('D.id_groupe', $groupes);
			$CI->db->group_by('libelle_menu');
			$CI->db->order_by('tri_menu');
			$result = $CI->db->get()->result();

			foreach($result as $r)
			{
				$menu = new Menu($r->id_menu, $r->libelle_menu, $r->url_menu);
				$sous_menus = $this->recupSousMenuBack($r->id_menu, $groupes);
				$menu->sous_menus = $sous_menus;

				array_push($menus, $menu);
			}
		}
		
		return $menus;
	}

	public function recupSousMenuBack($idMenu, $groupes)
	{
		$CI =& get_instance();
		$CI->db->distinct();
		$CI->db->select('SM.id_sous_menu, SM.libelle_sous_menu, SM.url_sous_menu');
		$CI->db->from('sous_menu SM');
		$CI->db->join('droit_sous_menu_groupe D', 'D.id_sous_menu = SM.id_sous_menu');
		$CI->db->where_in('D.id_groupe', $groupes);
		$CI->db->where('id_menu', $idMenu);

		return $CI->db->get()->result();
	}
}