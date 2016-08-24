<?php

class Accueil extends MY_Controller
{
    private $back = true;

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->has_userdata('id'))
            Redirect();

        $this->load->model('actualite_model');
        $this->load->model('back/actualite_back_model');
        $this->load->library('menu');
        //$this->load->model('accueil_model');
    }

    public function index()
    {
        $menu['title'] = "IPSSI - Accueil mon IPSSI";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

        $data['droit_insuffisant'] = $this->session->flashdata('droit_insuffisant');
        $data['actualites'] = $this->actualite_model->recupActualites('', 5, true);
        $data['actualiteBack'] = $this->actualite_back_model->recupActualitesBack();
       
        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/accueil.php', $data);
    }
}

?>
