<?php

class Actualites_back extends MY_Controller
{
	private $back = true;
	
    public function __construct()
    {
        parent::__construct();

        $this->load->library('menu');
        $this->load->model('back/ressources_humaines_back_model');
    }

    public function liste_actualites()
    {
        $menu['title'] = "IPSSI - Liste des actualités";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }
}

?>
