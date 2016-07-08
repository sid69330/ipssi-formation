<?php

class Saisie extends CI_Controller
{	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('menu');
		$this->load->model('saisie_model');
	}
	
	public function index()
	{
		$menu['title'] = "IPSSI - L'institut Privée Supérieur des Systèmes d'Information";
		$menu['menu'] = $this->menu->recupMenu();
		
		$data['menu'] = $menu['menu'];
		
		$this->load->view('include/menu.php', $menu);
		$this->load->view('saisie.php');
	}
}

?>
