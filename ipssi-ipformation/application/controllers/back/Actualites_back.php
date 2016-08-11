<?php

class Actualites_back extends MY_Controller
{
	private $back = true;
    private $droits = array();
	
    public function __construct()
    {
        parent::__construct();

        $this->load->library('menu');
        $this->load->model('back/actualite_back_model');

        $this->droits = parent::getDroits();
    }

    public function gestion_actualites()
    {
        $menu['title'] = "IPSSI - Gestion actualités - Liste des actualités";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $data['actualites'] = $this->actualite_back_model->liste_actualite($this->droits, $this->session->userdata('id'));       
        $data['droits'] = $this->droits;

        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/actualite/gestion_actualite/liste-actualite.php', $data);
    }

    public function ajouter_actualite()
    {
        $menu['title'] = "IPSSI - Gestion actualités - Ajouter une actualité";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        //$data['actualites'] = $this->actualite_back_model->liste_actualite($this->droits, $this->session->userdata('id'));       
        $data['droits'] = $this->droits;

        $this->form_validation->set_rules('titre', '"Titre"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('texte', '"Texte"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('date_validite', '"Date validité"', 'trim|encode_php_tags|regex_match[/^(0[1-9]|1[0-9]|2[0-9]|3(0|1))-(0[1-9]|1[0-2])-\d{4}]$/');

        if($this->form_validation->run() == FALSE)
        {
            $this->load->view('back/include/menu.php', $menu);
            $this->load->view('back/actualite/gestion_actualite/ajouter-actualite.php', $data);
        }
        else
        {

        }
    }
}

?>
