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
        $this->form_validation->set_rules('date_validite', '"Date validité"', 'trim|encode_php_tags');
        $this->form_validation->set_rules('actif', '"Actif"', 'trim|required|encode_php_tags|regex_match[/^[0-1]{1}$/]');
        $this->form_validation->set_rules('front', '"Front"', 'trim|required|encode_php_tags|regex_match[/^[0-1]{1}$/]');

        if($this->form_validation->run() == FALSE)
        {
            $data['success'] = $this->session->flashdata('success');
            $this->load->view('back/include/menu.php', $menu);
            $this->load->view('back/actualite/gestion_actualite/ajouter-actualite.php', $data);
        }
        else
        {
            $date_validite = $this->input->post('date_validite');
            $titre = $this->input->post('titre');
            $texte = $this->input->post('texte');
            $actif = $this->input->post('actif');
            $front = $this->input->post('front');

            $tab = explode('-', $date_validite);

            if(count($tab) == 3)
            {
                if(checkdate($tab[1], $tab[0], $tab[2]))
                {
                    if(mb_strlen($tab[2]) == 4)
                    {
                         $ok = $this->actualite_back_model->ajouter_actualite($titre, $texte, $actif, $front, $date_validite, $this->session->userdata('id'));

                        if($ok)
                        {
                            $this->session->set_flashdata('success', 'Actualité ajoutée avec succès.');
                            Redirect('/ipssi/actualites/gestion-actualites/ajouter');
                        }
                    }
                    else
                        $erreur = 'La date renseignée est au mauvais format. Format demandé : (dd-mm-yyyy)';
                }
                else
                    $erreur = 'La date renseignée n\'existe pas.';
            }
            else
                $erreur = 'La date renseignée est au mauvais format. Format demandé : (dd-mm-yyyy)';

            if(isset($erreur))
            {
                $data['erreur'] = $erreur;
                $this->load->view('back/include/menu.php', $menu);
                $this->load->view('back/actualite/gestion_actualite/ajouter-actualite.php', $data);
            }
        }
    }
}

?>
