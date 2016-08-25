<?php

class Ressources_humaines_back extends MY_Controller
{
    private $back = true;
    private $droits = array();
    
    public function __construct()
    {
        parent::__construct();

        $this->load->library('menu');
        $this->load->model('back/ressources_humaines_back_model');

        $this->droits = parent::getDroits();
    }

    public function cra()
    {
        $menu['title'] = "IPSSI - Comptes rendus d'activités";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }

    /* ----------- Notes de frais ----------- */

    public function note_frais()
    {
    	$menu['title'] = "IPSSI - Note de frais";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
        $data['droits'] = $this->droits;
        $data['notes_frais_personnelles'] = $this->ressources_humaines_back_model->recupNotesFraisPersonnelles($this->session->userdata('id'));
        $data['notes_frais_autres'] = $this->ressources_humaines_back_model->recupNotesFraisAutres($this->session->userdata('id'), $this->droits);
       
        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/ressources_humaines/liste-notes-frais.php', $data);
    }

    public function detail_note_frais($idNoteFrais = '')
    {
        if(($idNoteFrais == '') || (!$this->ressources_humaines_back_model->noteFraisExiste($idNoteFrais)))
            Redirect('/ipssi/ressources-humaines/note-frais');

        // droit suffisant en Lecture

        $menu['title'] = "IPSSI - Note de frais - Détail";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
        $data['droits'] = $this->droits;

        $data['notes_frais'] = $this->ressources_humaines_back_model->recupNoteFrais($idNoteFrais, $this->droits,$this->session->userdata('id'));
        $data['id_utilisateur_connecte'] = $this->session->userdata('id');

        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/ressources_humaines/detail-notes-frais.php', $data);
    }

    public function supprimer_note_frais($idNoteFrais = '')
    {
        if(($idNoteFrais == '') || (!$this->ressources_humaines_back_model->noteFraisExiste($idNoteFrais)))
            Redirect('/ipssi/ressources-humaines/note-frais');

        // droit suffisant en Lecture

        $menu['title'] = "IPSSI - Note de frais - Détail";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
        $data['droits'] = $this->droits;

        $ok = $this->ressources_humaines_back_model->supprimerNoteFrais($idNoteFrais, $this->session->userdata('id'), $this->droits);
        if($ok)
            $this->session->set_flashdata('success', 'Note de Frais supprimée avec succès.');
        else
            $this->session->set_flashdata('erreur', 'Impossible de supprimer cette note de frais.');

        Redirect('/ipssi/ressources-humaines/note-frais');
    }

    public function modifier_note_frais($idNoteFrais = '')
    {
        if(($idNoteFrais == '') || (!$this->ressources_humaines_back_model->noteFraisExiste($idNoteFrais)))
            Redirect('/ipssi/ressources-humaines/note-frais');

        $menu['title'] = "IPSSI - Note de frais - Détail";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
        $data['droits'] = $this->droits;
    }

    public function ajouter_note_frais()
    {
        $menu['title'] = "IPSSI - Note de frais - Détail";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
        $data['droits'] = $this->droits;
        $data['type_note_frais'] = $this->ressources_humaines_back_model->recupTypeNoteFrais();

        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/ressources_humaines/ajouter-notes-frais.php', $data);
    }

    public function valider_note_frais($idNoteFrais = '')
    {
        if(($idNoteFrais == '') || (!$this->ressources_humaines_back_model->noteFraisExiste($idNoteFrais)))
            Redirect('/ipssi/ressources-humaines/note-frais');

        $menu['title'] = "IPSSI - Note de frais - Détail";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
        $data['droits'] = $this->droits;
    }

    /* --------------------------------------- */

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
