<?php

class Parametrage_back extends MY_Controller
{
    private $back = true;
    
    public function __construct()
    {
        parent::__construct();

        $this->load->library('menu');
        $this->load->model('back/ressources_humaines_back_model');
    }

    public function rh()
    {
        $menu['title'] = "IPSSI - Ressources humaines";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }

    public function crm()
    {
        $menu['title'] = "IPSSI - CRM";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }
}


?>
