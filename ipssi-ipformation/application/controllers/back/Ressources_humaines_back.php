<?php

class Ressources_humaines_back extends MY_Controller
{
    private $back = true;
    
    public function __construct()
    {
        parent::__construct();

        $this->load->library('menu');
        $this->load->model('back/ressources_humaines_back_model');
    }

    public function cra()
    {
        $menu['title'] = "IPSSI - Comptes rendus d'activités";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }

    public function note_frais()
    {
    	$menu['title'] = "IPSSI - Note de frais";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }

    public function demande_conges()
    {
    	$menu['title'] = "IPSSI - Demande de congés";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }

    public function cvtheque()
    {
    	$menu['title'] = "IPSSI - CV-thèque";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }

    public function offre_poste()
    {
        $menu['title'] = "IPSSI - Offre de poste";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }

    public function candidatures()
    {
        $menu['title'] = "IPSSI - Candidatures";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }

    public function collaborateurs()
    {
        $menu['title'] = "IPSSI - Collaborateurs";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }
}


?>
