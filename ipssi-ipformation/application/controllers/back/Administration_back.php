<?php

class Administration_back extends MY_Controller
{
    private $back = true;
    private $droits = array();
    
    public function __construct()
    {
        parent::__construct();

        $this->load->library('menu');
        $this->load->library('droit');
        $this->load->model('back/administration_back_model');

        $this->droits = parent::getDroits();

        //print_r($this->droits);
    }

    public function gestion_utilisateurs()
    {
        $menu['title'] = "IPSSI - Gestion des utilisateurs";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

        $data['utilisateurs'] = $this->administration_back_model->liste_utilisateurs($this->droits, $this->session->userdata('id'));
        $data['droits'] = $this->droits;
       
        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/administration/gestion_utilisateur/liste-utilisateurs.php', $data);
    }

    public function detail_utilisateur($id_utilisateur = '')
    {
        if(($id_utilisateur == '') || (!$this->administration_back_model->utilisateurExiste($id_utilisateur)) || (!$this->droit->droitSuffisantLecture($this->droits, $id_utilisateur, $this->session->userdata('id'))))
            Redirect('/ipssi/administration/gestion-utilisateurs');

        $data['infos'] = $this->administration_back_model->recup_infos_utilisateur($id_utilisateur);

        $menu['title'] = "IPSSI - Détail de l'utilisateur ".$data['infos']->nom_utilisateur.' '.$data['infos']->prenom_utilisateur;
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

        $data['droits'] = $this->droits;
       
        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/administration/gestion_utilisateur/detail-utilisateurs.php', $data);
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
