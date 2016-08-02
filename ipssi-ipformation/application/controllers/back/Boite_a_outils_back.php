<?php

class Boite_a_outils_back extends MY_Controller
{
    private $back = true;
    
    public function __construct()
    {
        parent::__construct();

        $this->load->library('menu');
    }

    public function certifications()
    {
        $menu['title'] = "IPSSI - Certifications";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }

    public function documents_travail()
    {
        $menu['title'] = "IPSSI - Documents de travail";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }
}

?>
