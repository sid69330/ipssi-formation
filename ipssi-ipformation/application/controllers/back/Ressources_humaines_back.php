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

        $menu['title'] = "IPSSI - Note de frais - Supprimer";
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

        $data['note_frais'] = $this->ressources_humaines_back_model->recupNoteFraisAModifier($idNoteFrais, $this->session->userdata('id'), $this->droits);
        $data['type_note_frais'] = $this->ressources_humaines_back_model->recupTypeNoteFrais();


        if($this->droit->droitSuffisantModifier($this->droits, $data['note_frais']->id_utilisateur, $this->session->userdata('id')))
        {
            $this->form_validation->set_rules('type_note_frais', '"Type de la note"', 'required');
            $this->form_validation->set_rules('description', '"Description"', 'trim|required|encode_php_tags');
            $this->form_validation->set_rules('date_note', '"Date note de Frais"', 'required|date|encode_php_tags');
            $this->form_validation->set_rules('montant', '"Montant de la note"', 'required|encode_php_tags');

            
            if($this->form_validation->run() == FALSE)
            {

                $menu['title'] = "IPSSI - Note de frais - Modifier";
                $menu['back'] = $this->back;
                $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
               
                $data['success'] = $this->session->flashdata('success');
                $data['droits'] = $this->droits;

                $this->load->view('back/include/menu.php', $menu);
                $this->load->view('back/ressources_humaines/modifier-notes-frais.php', $data);
            }
            else
            {
                $erreur = '';

                $type_note_frais = $this->input->post('type_note_frais');
                $description = $this->input->post('description');
                $date_note = $this->input->post('date_note');
                $montant = $this->input->post('montant');
                $trajet = $this->input->post('trajet');
                $km_parcouru = $this->input->post('km_parcouru');
                $prix_km = $this->input->post('prix_km');

                if($erreur != '')
                {
                    $menu['title'] = "IPSSI - Note de frais - Modifier";
                    $menu['back'] = $this->back;
                    $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
                    $data['erreur'] = $erreur;

                    $this->load->view('back/include/menu.php', $menu);
                    $this->load->view('back/ressources_humaines/modifier-notes-frais.php', $data);
                }
                else
                {                  
                    $this->ressources_humaines_back_model->modifier_note_frais($type_note_frais, $description, $date_note, $montant, $trajet, $km_parcouru, $prix_km, $data['note_frais']->id_note_frais);
                    $this->session->set_flashdata('success', 'Note de Frais modifiée avec succès.');
                        Redirect('/ipssi/ressources-humaines/note-frais/modifier/'.$data['note_frais']->id_note_frais);
                }

            }
        }
        else
            Redirect('/ipssi/ressources-humaines/note-frais');
    }

    public function ajouter_note_frais()
    {
        $menu['title'] = "IPSSI - Note de frais - Ajouter";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $data['droits'] = $this->droits;
        $data['type_note_frais'] = $this->ressources_humaines_back_model->recupTypeNoteFrais();

        $this->form_validation->set_rules('type_note_frais', '"Type de la note"', 'required');
        $this->form_validation->set_rules('description', '"Description"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('date_note', '"Date note de Frais"', 'required|date|encode_php_tags');
        $this->form_validation->set_rules('montant', '"Montant de la note"', 'required|encode_php_tags');

        if($this->form_validation->run() == FALSE)
        {
            $data['success'] = $this->session->flashdata('success');
            $this->load->view('back/include/menu.php', $menu);
            $this->load->view('back/ressources_humaines/ajouter-notes-frais.php', $data);
        }
        else
        {
            if(isset($erreur))
            {
                $data['erreur'] = $erreur;
                $this->load->view('back/include/menu.php', $menu);
                $this->load->view('back/ressources_humaines/ajouter-notes-frais.php', $data);
            }
            else
            {

                $erreur = '';

                $type_note_frais = $this->input->post('type_note_frais');
                $description = $this->input->post('description');
                $date_note = $this->input->post('date_note');
                $montant = $this->input->post('montant');
                $trajet = $this->input->post('trajet');
                $km_parcouru = $this->input->post('km_parcouru');
                $prix_km = $this->input->post('prix_km');

                $id_insere = $this->ressources_humaines_back_model->ajouter_note_frais($type_note_frais, $description, $date_note, $montant, $trajet, $km_parcouru, $prix_km, $this->session->userdata('id'));
                if($id_insere != '')
                {
                    $this->session->set_flashdata('success', 'Note de frais ajoutée avec succès.');
                        Redirect('/ipssi/ressources-humaines/note-frais/ajouter');    
                }
                else
                {
                    $data['erreur'] = 'Aucune modification effectuée.';
                    $this->load->view('back/include/menu.php', $menu);
                    $this->load->view('back/ressources_humaines/ajouter-notes-frais.php', $data);
                }                
            }
        }
    }

    public function valider_note_frais($idNoteFrais = '')
    {

        //Validation N+1 et/ou RH
        //Ajouter les champs Type de paiement + date de paiement 
        // Si etat <> 3 => motif_refus = null


        if(($idNoteFrais == '') || (!$this->ressources_humaines_back_model->noteFraisExiste($idNoteFrais)))
            Redirect('/ipssi/ressources-humaines/note-frais');

        $data['note_frais'] = $this->ressources_humaines_back_model->recupNoteFraisAModifier($idNoteFrais, $this->session->userdata('id'), $this->droits);
        $data['etat_note_frais'] = $this->ressources_humaines_back_model->recupEtatNoteFrais();

        if($this->droit->droitSuffisantModifier($this->droits, $data['note_frais']->id_utilisateur, $this->session->userdata('id')))
        {
            $this->form_validation->set_rules('etat_note_frais', '"Etat de la note"', 'required');
            if($this->input->post('etat_note_frais') == 3)
                $this->form_validation->set_rules('motif_refus', '"Motif du refus"', 'required');
            

            if($this->form_validation->run() == FALSE)
            {

                $menu['title'] = "IPSSI - Note de frais - Valider";
                $menu['back'] = $this->back;
                $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
               
                $data['success'] = $this->session->flashdata('success');
                $data['droits'] = $this->droits;

                $this->load->view('back/include/menu.php', $menu);
                $this->load->view('back/ressources_humaines/valider-notes-frais.php', $data);
            }
            else
            {
                $erreur = '';

                $etat_note_frais = $this->input->post('etat_note_frais');
                $motif_refus = $this->input->post('motif_refus');

                if($erreur != '')
                {
                    $menu['title'] = "IPSSI - Note de frais - Valider";
                    $menu['back'] = $this->back;
                    $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
                    $data['erreur'] = $erreur;

                    $this->load->view('back/include/menu.php', $menu);
                    $this->load->view('back/ressources_humaines/valider-notes-frais.php', $data);
                }
                else
                {                  
                    $this->ressources_humaines_back_model->valider_note_frais($data['note_frais']->id_note_frais,$etat_note_frais, $smotif_refus);
                    $this->session->set_flashdata('success', 'Note de Frais modifiée avec succès.');
                        Redirect('/ipssi/ressources-humaines/note-frais/valider/'.$data['note_frais']->id_note_frais);
                }

            }
        }
        else
            Redirect('/ipssi/ressources-humaines/note-frais');
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
