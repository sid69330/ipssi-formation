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

    /* ---------- Page Gestion des utilisateurs ---------- */

    /* Liste des utilisateurs */
    public function gestion_utilisateurs()
    {
        $menu['title'] = "IPSSI - Gestion des utilisateurs";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

        $data['utilisateurs'] = $this->administration_back_model->liste_utilisateurs($this->droits, $this->session->userdata('id'));
        $data['droits'] = $this->droits;
        $data['success'] = $this->session->flashdata('success');
       
        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/administration/gestion_utilisateur/liste-utilisateurs.php', $data);
    }

    /* Détail utilisateur */
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

    public function modifier_utilisateur($id_utilisateur = '')
    {
        if(($id_utilisateur == '') || (!$this->administration_back_model->utilisateurExiste($id_utilisateur)) || (!$this->droit->droitSuffisantModifier($this->droits, $id_utilisateur, $this->session->userdata('id'))))
            Redirect('/ipssi/administration/gestion-utilisateurs');

        $this->load->library('methodes_globales');

        $data['infos'] = $this->administration_back_model->recup_infos_utilisateur($id_utilisateur);

        $menu['title'] = "IPSSI - Modification de l'utilisateur ".$data['infos']->nom_utilisateur.' '.$data['infos']->prenom_utilisateur;
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

        $data['droits'] = $this->droits;
        $data['sexes'] = $this->methodes_globales->recup_sexe();
        $data['groupes'] = $this->methodes_globales->recup_groupe();
        $data['groupes_utilisateur'] = $this->administration_back_model->recup_groupe_utilisateur($id_utilisateur);

        $this->form_validation->set_rules('sexe', '"Sexe"', 'trim|required|is_exist[sexe.id_sexe]|encode_php_tags');
        $this->form_validation->set_rules('nom', '"Nom"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('prenom', '"Prénom"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('email', '"Email"', 'trim|required|valid_email|encode_php_tags');
        $this->form_validation->set_rules('tel', '"Téléphone"', 'trim|encode_php_tags|regex_match[/^0[0-9]{9}$/]');
        $this->form_validation->set_rules('entreprise', '"Entreprise"', 'trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $data['success'] = $this->session->flashdata('success');
            $this->load->view('back/include/menu.php', $menu);
            $this->load->view('back/administration/gestion_utilisateur/modifier-utilisateurs.php', $data);
        }
        else
        {
            $email = mb_strtolower($this->input->post('email'));

            if($this->administration_back_model->email_unique_utilisateur($id_utilisateur, $email))
            {
                $groupes = array();
                $sexe = $this->input->post('sexe');
                $nom = mb_strtoupper($this->input->post('nom'));
                $prenom = ucfirst(mb_strtolower($this->input->post('prenom')));
                $tel = $this->input->post('tel');
                $entreprise = $this->input->post('entreprise');
                $groupes = $this->input->post('groupes');

                $this->administration_back_model->modifier_utilisateur($sexe, $nom, $prenom, $email, $tel, $entreprise, $groupes, $id_utilisateur);

                $this->session->set_flashdata('success', 'L\'utilisateur a été modifié avec succès.');
                Redirect('/ipssi/administration/gestion-utilisateurs/modifier/'.$id_utilisateur);
            }
            else
            {
                $data['erreurMail'] = 'Le champ "Email" doit contenir une valeur unique.';
                $this->load->view('back/include/menu.php', $menu);
                $this->load->view('back/administration/gestion_utilisateur/modifier-utilisateurs.php', $data);
            }
        }
    }

    public function ajouter()
    {
        if(!$this->droit->droitSuffisantAjouter($this->droits))
            Redirect('/ipssi/administration/gestion-utilisateurs');

        $this->load->library('methodes_globales');

        $menu['title'] = "IPSSI - Ajouter un utilisateur";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

        $data['droits'] = $this->droits;
        $data['sexes'] = $this->methodes_globales->recup_sexe();
        $data['groupes'] = $this->methodes_globales->recup_groupe();

        $this->form_validation->set_rules('sexe', '"Sexe"', 'trim|required|is_exist[sexe.id_sexe]|encode_php_tags');
        $this->form_validation->set_rules('nom', '"Nom"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('prenom', '"Prénom"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('email', '"Email"', 'trim|required|valid_email|is_unique[utilisateur.mail_utilisateur]|encode_php_tags');
        $this->form_validation->set_rules('tel', '"Téléphone"', 'trim|encode_php_tags|regex_match[/^0[0-9]{9}$/]');
        $this->form_validation->set_rules('mdp', '"Mot de passe"', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('entreprise', '"Entreprise"', 'trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $data['success'] = $this->session->flashdata('success');
            $this->load->view('back/include/menu.php', $menu);
            $this->load->view('back/administration/gestion_utilisateur/ajouter-utilisateur.php', $data);
        }
        else
        {
            $sexe = $this->input->post('sexe');
            $nom = mb_strtoupper($this->input->post('nom'));
            $prenom = ucfirst(mb_strtolower($this->input->post('prenom')));
            $email = $this->input->post('email');
            $tel = $this->input->post('tel');
            $mdp = hash('sha256', $this->input->post('mdp'));
            $entreprise = $this->input->post('entreprise');
            $groupes = $this->input->post('groupes');

            $ok = $this->administration_back_model->ajouter_utilisateur($sexe, $nom, $prenom, $email, $tel, $mdp, $entreprise, $groupes);

            if($ok)
            {
                $this->session->set_flashdata('success', 'Le nouvel utilisateur a été ajouté avec succès.');
                Redirect('/ipssi/administration/gestion-utilisateurs/ajouter');
            }
            else
            {
                $data['erreur'] = 'Une erreur est survenue pendant l\'ajout du nouvel utilisateur';
                $this->load->view('back/include/menu.php', $menu);
                $this->load->view('back/administration/gestion_utilisateur/ajouter-utilisateur.php', $data);
            }
        }
    }

    public function supprimer_utilisateur($id_utilisateur)
    {
        if(($id_utilisateur == '') || (!$this->administration_back_model->utilisateurExiste($id_utilisateur)) || (!$this->droit->droitSuffisantSupprimer($this->droits)))
            Redirect('/ipssi/administration/gestion-utilisateurs');

        if($this->session->userdata('id') != $id_utilisateur)
        {
            $this->administration_back_model->supprimer_utilisateur($id_utilisateur);
            $this->session->set_flashdata('success', 'Utilisateur supprimé avec succès.');
        }

        Redirect('/ipssi/administration/gestion-utilisateurs');
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
