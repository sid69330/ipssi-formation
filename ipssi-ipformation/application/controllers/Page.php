<?php

class Page extends CI_Controller
{	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('menu');
		$this->load->model('page_model');
		$this->load->model('actualite_model');
	}
	
	public function index()
	{
		$menu['title'] = "IPSSI - L'institut Privée Supérieur des Systèmes d'Information";
		$menu['menu'] = $this->menu->recupMenu();
		
		$data['actualite'] = $this->actualite_model->recupActualites();
		
		$this->load->view('include/menu.php', $menu);
		$this->load->view('accueil.php', $data);
	}

	public function afficher($menu, $sous_menu='')
	{
		if($menu != '')
		{
			$page = $this->page_model->pageExiste($menu, $sous_menu);
			
			if($page[0]->nb == 1)
			{
				$data['infosPage'] = $this->page_model->recupInfosPage($page[0]->id_menu, $page[0]->id_sous_menu);
				$men['menu'] = $this->menu->recupMenu();
				$men['title'] = $data['infosPage']->titre_page_contenu;
				
				if($sous_menu != '')
					$men['sous_sous_menu'] = $this->menu->recupSousSousMenu($page[0]->id_sous_menu);
				else
					$men['sous_sous_menu'] = null;

				$this->load->view('include/menu.php', $men);
				$this->load->view('page.php', $data);
			}
			else
				Redirect();
		}
		else
			Redirect();
	}
}

?>
