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
    }

    /* ---------- Gestion des droits ---------- */

    public function gestion_droits()
    {
        $droits = $this->input->post('droits');
        
        if(count($droits) > 0)
        {
            $this->administration_back_model->majDroits($droits);

            //Redirect('/ipssi/administration/gestion-des-droits');
        }

        $menu['title'] = "IPSSI - Gestion de l'application";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

        $data['droits_page'] = $this->administration_back_model->recupDroits($this->droits, $this->session->userdata('id'));
        $data['droits'] = $this->droits;

        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/administration/gestion_droits/liste-des-droits.php', $data);
    }

    /* ---------- Page Application ---------- */

    public function application()
    {
        $menu['title'] = "IPSSI - Gestion de l'application";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }

    /* ---------- Page Rédaction des pages ---------- */

    public function redaction_pages()
    {
        $menu['title'] = "IPSSI - Gestion des pages Front";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

        $data['droits'] = $this->droits;
        $data['pages'] = $this->administration_back_model->recup_redaction_pages();
       
        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/administration/redaction_pages/liste-redaction-pages.php', $data);
    }

    public function detail_redaction_pages($libelle_menu = '', $libelle_sous_menu = '')
    {
        if((($libelle_menu == '') && $libelle_sous_menu == '') || (!$this->administration_back_model->menu_sous_menu_existe($libelle_menu, $libelle_sous_menu)) || (!$this->droit->droitSuffisantLectureSimple($this->droits)))
            Redirect('/ipssi/administration/redaction-pages');

        $menu['title'] = "IPSSI - Détail de la page Front - ".str_replace('-', ' ', ucfirst($libelle_menu))." - ".str_replace('-', ' ', ucfirst($libelle_sous_menu));
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

        $data['droits'] = $this->droits;
        $data['page'] = $this->administration_back_model->recup_detail_redaction_pages($libelle_menu, $libelle_sous_menu);
        $data['libelle_menu'] = str_replace('-', ' ', ucfirst($libelle_menu));
        $data['libelle_sous_menu'] = str_replace('-', ' ', ucfirst($libelle_sous_menu));
       
        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/administration/redaction_pages/detail-redaction-pages.php', $data);
    }

    public function modifier_redaction_pages($libelle_menu = '', $libelle_sous_menu = '')
    {
        if((($libelle_menu == '') && $libelle_sous_menu == '') || (!$this->administration_back_model->menu_sous_menu_existe($libelle_menu, $libelle_sous_menu)) || (!$this->droit->droitSuffisantModifierSimple($this->droits)))
            Redirect('/ipssi/administration/redaction-pages');

        $menu['title'] = "IPSSI - Modification de la page Front - ".str_replace('-', ' ', ucfirst($libelle_menu))." - ".str_replace('-', ' ', ucfirst($libelle_sous_menu));
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

        $data['droits'] = $this->droits;
        $data['page'] = $this->administration_back_model->recup_detail_redaction_pages($libelle_menu, $libelle_sous_menu);
        $data['libelle_menu'] = str_replace('-', ' ', ucfirst($libelle_menu));
        $data['libelle_sous_menu'] = str_replace('-', ' ', ucfirst($libelle_sous_menu));
       
        $this->form_validation->set_rules('contenu', '"Contenu"', 'trim|encode_php_tags');

        if($this->form_validation->run() == FALSE)
        {
            $data['success'] = $this->session->flashdata('success');
            $this->load->view('back/include/menu.php', $menu);
            $this->load->view('back/administration/redaction_pages/modifier-redaction-pages.php', $data);
        }
        else
        {
            $contenu = $this->input->post('contenu', false); 

            $this->administration_back_model->modifier_contenu_page($data['page']->id_menu, $data['page']->id_sous_menu, $contenu);
            
            $this->session->set_flashdata('success', 'Contenu de la page mis à jour avec succès.');
            Redirect('/ipssi/administration/redaction-pages/modifier/'.$libelle_menu.'/'.$libelle_sous_menu);
        }
    }
}


?>
