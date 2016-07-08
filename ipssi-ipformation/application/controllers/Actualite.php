<?php

class Actualite extends CI_Controller
{	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('menu');
		$this->load->model('actualite_model');
	}
	
	public function index()
	{
		
		$menu['title'] = "Actualité";
		$menu['menu'] = $this->menu->recupMenu();
		
		$data['actualite'] = $this->actualite_model->recupActualites();
		
		$this->load->view('include/menu.php', $menu);
		$this->load->view('actualite.php', $data);
	}
	
	public function detail($id = '')
	{
		if($id=='')
			Redirect();

		if($this->actualite_model->actualiteExiste($id))
		{
			$menu['title'] = "Actualité";
			$menu['menu'] = $this->menu->recupMenu();
			$data['actualite'] = $this->actualite_model->recupActualites($id);

			$this->load->view('include/menu.php', $menu);
			$this->load->view('actualite/actualite_detail.php', $data);
		}
		else
			Redirect('/');
	}
}

?>
