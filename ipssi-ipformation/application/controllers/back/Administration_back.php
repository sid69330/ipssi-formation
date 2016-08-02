<?php

class Administration_back extends MY_Controller
{
    private $back = true;
    
    public function __construct()
    {
        parent::__construct();

        $this->load->library('menu');
        $this->load->model('back/ressources_humaines_back_model');
    }

    public function gestion_utilisateurs()
    {
        $menu['title'] = "IPSSI - Gestion des utilisateurs";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }

    public function application()
    {
        $menu['title'] = "IPSSI - Gestion de l'application";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }

    public function redaction_pages()
    {
        $menu['title'] = "IPSSI - Gestion des pages Front";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }
}


?>
