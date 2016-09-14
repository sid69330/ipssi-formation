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


    /* ---------- Page Gestion des utilisateurs ---------- */

    /* Liste des utilisateurs */
    public function gestion_utilisateurs()
    {
        $menu['title'] = "IPSSI - Gestion des utilisateurs";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

        $data['utilisateurs'] = $this->ressources_humaines_back_model->liste_utilisateurs($this->droits, $this->session->userdata('id'));
        $data['droits'] = $this->droits;
        $data['success'] = $this->session->flashdata('success');
       
        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/ressources_humaines/gestion_utilisateur/liste-utilisateurs.php', $data);
    }

    /* Détail utilisateur */
    public function detail_utilisateur($id_utilisateur = '')
    {
        if(($id_utilisateur == '') || (!$this->ressources_humaines_back_model->utilisateurExiste($id_utilisateur)) || (!$this->droit->droitSuffisantLecture($this->droits, $id_utilisateur, $this->session->userdata('id'))))
            Redirect('/ipssi/ressources-humaines/collaborateurs');

        $data['infos'] = $this->ressources_humaines_back_model->recup_infos_utilisateur($id_utilisateur);

        $menu['title'] = "IPSSI - Détail de l'utilisateur ".$data['infos']->nom_utilisateur.' '.$data['infos']->prenom_utilisateur;
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

        $data['droits'] = $this->droits;
       
        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/ressources_humaines/gestion_utilisateur/detail-utilisateurs.php', $data);
    }

    public function modifier_utilisateur($id_utilisateur = '')
    {
        if(($id_utilisateur == '') || (!$this->ressources_humaines_back_model->utilisateurExiste($id_utilisateur)) || (!$this->droit->droitSuffisantModifier($this->droits, $id_utilisateur, $this->session->userdata('id'))))
            Redirect('/ipssi/ressources-humaines/collaborateurs');

        $this->load->library('methodes_globales');

        $data['infos'] = $this->ressources_humaines_back_model->recup_infos_utilisateur($id_utilisateur);

        $menu['title'] = "IPSSI - Modification de l'utilisateur ".$data['infos']->nom_utilisateur.' '.$data['infos']->prenom_utilisateur;
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

        $data['droits'] = $this->droits;
        $data['sexes'] = $this->methodes_globales->recup_sexe();
        $data['groupes'] = $this->methodes_globales->recup_groupe();
        $data['groupes_utilisateur'] = $this->ressources_humaines_back_model->recup_groupe_utilisateur($id_utilisateur);

        $this->form_validation->set_rules('sexe', '"Sexe"', 'trim|required|is_exist[sexe.id_sexe]|encode_php_tags');
        $this->form_validation->set_rules('nom', '"Nom"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('prenom', '"Prénom"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('email', '"Email"', 'trim|required|valid_email|encode_php_tags');
        $this->form_validation->set_rules('tel', '"Téléphone"', 'trim|encode_php_tags|regex_match[/^0[0-9]{9}$/]');
        $this->form_validation->set_rules('entreprise', '"Entreprise"', 'trim|required');
        $this->form_validation->set_rules('actif', '"Actif"', 'trim|encode_php_tags|regex_match[/^[0-1]$/]');

        if($this->form_validation->run() == FALSE)
        {
            $data['success'] = $this->session->flashdata('success');
            $this->load->view('back/include/menu.php', $menu);
            $this->load->view('back/ressources_humaines/gestion_utilisateur/modifier-utilisateurs.php', $data);
        }
        else
        {
            $email = mb_strtolower($this->input->post('email'));

            if($this->ressources_humaines_back_model->email_unique_utilisateur($id_utilisateur, $email))
            {
                $groupes = array();
                $sexe = $this->input->post('sexe');
                $nom = mb_strtoupper($this->input->post('nom'));
                $prenom = ucfirst(mb_strtolower($this->input->post('prenom')));
                $tel = $this->input->post('tel');
                $entreprise = $this->input->post('entreprise');
                $groupes = $this->input->post('groupes');
                $actif = $this->input->post('actif');

                $this->ressources_humaines_back_model->modifier_utilisateur($sexe, $nom, $prenom, $email, $tel, $entreprise, $groupes, $actif, $id_utilisateur);

                $this->session->set_flashdata('success', 'L\'utilisateur a été modifié avec succès.');
                Redirect('/ipssi/ressources-humaines/collaborateurs/modifier/'.$id_utilisateur);
            }
            else
            {
                $data['erreurMail'] = 'Le champ "Email" doit contenir une valeur unique.';
                $this->load->view('back/include/menu.php', $menu);
                $this->load->view('back/ressources_humaines/gestion_utilisateur/modifier-utilisateurs.php', $data);
            }
        }
    }

    public function ajouter()
    {
        if(!$this->droit->droitSuffisantAjouter($this->droits))
            Redirect('/ipssi/ressources-humaines/collaborateurs');

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
        $this->form_validation->set_rules('entreprise', '"Entreprise"', 'trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $data['success'] = $this->session->flashdata('success');
            $this->load->view('back/include/menu.php', $menu);
            $this->load->view('back/ressources_humaines/gestion_utilisateur/ajouter-utilisateur.php', $data);
        }
        else
        {
            $sexe = $this->input->post('sexe');
            $nom = mb_strtoupper($this->input->post('nom'));
            $prenom = ucfirst(mb_strtolower($this->input->post('prenom')));
            $email = $this->input->post('email');
            $tel = $this->input->post('tel');
            $mdp = hash('sha256', ucfirst(strtolower(substr($prenom, 0, 1))).strtolower(str_replace(' ', '', $nom)));
            $entreprise = $this->input->post('entreprise');
            $groupes = $this->input->post('groupes');

            $ok = $this->ressources_humaines_back_model->ajouter_utilisateur($sexe, $nom, $prenom, $email, $tel, $mdp, $entreprise, $groupes);

            if($ok)
            {
                $this->session->set_flashdata('success', 'Le nouvel utilisateur a été ajouté avec succès.');
                Redirect('/ipssi/ressources-humaines/collaborateurs/ajouter');
            }
            else
            {
                $data['erreur'] = 'Une erreur est survenue pendant l\'ajout du nouvel utilisateur';
                $this->load->view('back/include/menu.php', $menu);
                $this->load->view('back/ressources_humaines/gestion_utilisateur/ajouter-utilisateur.php', $data);
            }
        }
    }

    public function supprimer_utilisateur($id_utilisateur)
    {
        if(($id_utilisateur == '') || (!$this->ressources_humaines_back_model->utilisateurExiste($id_utilisateur)) || (!$this->droit->droitSuffisantSupprimer($this->droits)))
            Redirect('/ipssi/ressources-humaines/collaborateurs');

        if($this->session->userdata('id') != $id_utilisateur)
        {
            $this->ressources_humaines_back_model->supprimer_utilisateur($id_utilisateur);
            $this->session->set_flashdata('success', 'Utilisateur supprimé avec succès.');
        }

        Redirect('/ipssi/ressources-humaines/collaborateurs');
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
        $this->load->view('back/ressources_humaines/gestion_notes_frais/liste-notes-frais.php', $data);
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
        $this->load->view('back/ressources_humaines/gestion_notes_frais/detail-notes-frais.php', $data);
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
                $this->load->view('back/ressources_humaines/gestion_notes_frais/modifier-notes-frais.php', $data);
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
                    $this->load->view('back/ressources_humaines/gestion_notes_frais/modifier-notes-frais.php', $data);
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
            $this->load->view('back/ressources_humaines/gestion_notes_frais/ajouter-notes-frais.php', $data);
        }
        else
        {
            if(isset($erreur))
            {
                $data['erreur'] = $erreur;
                $this->load->view('back/include/menu.php', $menu);
                $this->load->view('back/ressources_humaines/gestion_notes_frais/ajouter-notes-frais.php', $data);
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
                    $this->load->view('back/ressources_humaines/gestion_notes_frais/ajouter-notes-frais.php', $data);
                }                
            }
        }
    }

    public function valider_note_frais($idNoteFrais = '')
    {

        //Validation N+1 et/ou RH
        // Si etat <> 3 => motif_refus = null


        if(($idNoteFrais == '') || (!$this->ressources_humaines_back_model->noteFraisExiste($idNoteFrais)))
            Redirect('/ipssi/ressources-humaines/note-frais');

        $data['note_frais'] = $this->ressources_humaines_back_model->recupNoteFraisAModifier($idNoteFrais, $this->session->userdata('id'), $this->droits);
        $data['etat_note_frais'] = $this->ressources_humaines_back_model->recupEtatNoteFrais();
        $data['paiement_note_frais'] = $this->ressources_humaines_back_model->recupPaiementNoteFrais();

        if($this->droit->droitSuffisantModifier($this->droits, $data['note_frais']->id_utilisateur, $this->session->userdata('id')))
        {
            $this->form_validation->set_rules('etat_note_frais', '"Etat de la note"', 'required');
            if($this->input->post('etat_note_frais') == 3)
                $this->form_validation->set_rules('motif_refus', '"Motif du refus"', 'required');
            $this->form_validation->set_rules('type_paiement', '"Type de Paiement"', 'required');
            

            if($this->form_validation->run() == FALSE)
            {

                $menu['title'] = "IPSSI - Note de frais - Valider";
                $menu['back'] = $this->back;
                $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
               
                $data['success'] = $this->session->flashdata('success');
                $data['droits'] = $this->droits;

                $this->load->view('back/include/menu.php', $menu);
                $this->load->view('back/ressources_humaines/gestion_notes_frais/valider-notes-frais.php', $data);
            }
            else
            {
                $erreur = '';

                $etat_note_frais = $this->input->post('etat_note_frais');
                $motif_refus = $this->input->post('motif_refus');
                $type_paiement = $this->input->post('type_paiement');

                if($erreur != '')
                {
                    $menu['title'] = "IPSSI - Note de frais - Valider";
                    $menu['back'] = $this->back;
                    $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
                    $data['erreur'] = $erreur;

                    $this->load->view('back/include/menu.php', $menu);
                    $this->load->view('back/ressources_humaines/gestion_notes_frais/valider-notes-frais.php', $data);
                }
                else
                {                  
                    $this->ressources_humaines_back_model->valider_note_frais($data['note_frais']->id_note_frais,$etat_note_frais, $smotif_refus, $type_paiement);
                    $this->session->set_flashdata('success', 'Note de Frais validée avec succès.');
                        Redirect('/ipssi/ressources-humaines/note-frais/valider/'.$data['note_frais']->id_note_frais);
                }

            }
        }
        else
            Redirect('/ipssi/ressources-humaines/note-frais');
    }

    /* --------------------------------------- */

    /* ---------------- Les postes à pourvoir ----------------------- */

     public function offre_poste()
    {
        $menu['title'] = "IPSSI - Offre de poste";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
        $data['droits'] = $this->droits;
        $data['postes'] = $this->ressources_humaines_back_model->recupPostes();
       
        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/ressources_humaines/gestion_postes/offre-poste.php', $data);
    }

    public function detail_poste($id_poste = '')
    {
        if($id_poste == '')
            Redirect('/ipssi/ressources-humaines/offre-poste');


        $menu['title'] = "IPSSI - Détail de poste";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
        $data['droits'] = $this->droits;
        $data['poste'] = $this->ressources_humaines_back_model->recupPoste($id_poste);
       
        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/ressources_humaines/gestion_postes/detail-poste.php', $data);
    }

    public function supprimer_poste($id_poste = '')
    {
        if(($id_poste == '') || (count($this->ressources_humaines_back_model->recupPoste($id_poste)) == 0))
            Redirect('/ipssi/ressources-humaines/offre-poste');

        $menu['title'] = "IPSSI - Poste à pourvoir - Supprimer";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
        $data['droits'] = $this->droits;

        $this->ressources_humaines_back_model->supprimerPoste($id_poste);
        $this->session->set_flashdata('success', 'Poste à pourvoir supprimé avec succès.');

        Redirect('/ipssi/ressources-humaines/offre-poste');
    }

    public function modifier_poste($id_poste = '')
    {
        if(($id_poste == '') || (count($this->ressources_humaines_back_model->recupPoste($id_poste)) == 0))
            Redirect('/ipssi/ressources-humaines/offre-poste');


        $this->form_validation->set_rules('type_poste', '"Type de poste"', 'required');
        $this->form_validation->set_rules('titre', '"Titre du poste"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('accroche', '"Accroche du poste"', 'required|encode_php_tags');
        $this->form_validation->set_rules('description', '"Desciption du poste"', 'required|encode_php_tags');
        $this->form_validation->set_rules('date_debut_poste', '"Date de début de contrat"', 'required|date|encode_php_tags');
        $this->form_validation->set_rules('niveau', '"Niveau d\'expérience"', 'required|encode_php_tags');

            
        if($this->form_validation->run() == FALSE)
        {
            $menu['title'] = "IPSSI - Modifier poste";
            $menu['back'] = $this->back;
            $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
            $data['droits'] = $this->droits;
            $data['type_poste'] = $this->ressources_humaines_back_model->recupTypePoste();
            $data['poste'] = $this->ressources_humaines_back_model->recupPoste($id_poste);
           
            $this->load->view('back/include/menu.php', $menu);
            $this->load->view('back/ressources_humaines/gestion_postes/modifier-poste.php', $data);
        }
        else
        {
            $erreur = '';

            $type_poste = $this->input->post('type_poste');
            $titre = $this->input->post('titre');
            $accroche = $this->input->post('accroche');
            $description = $this->input->post('description');
            $date_debut_poste = $this->input->post('date_debut_poste');
            $niveau = $this->input->post('niveau');
            $remuneration = $this->input->post('remuneration');
            $entreprise = $this->input->post('entreprise');

            if($erreur != '')
            {
                $menu['title'] = "IPSSI - Postes à pourvoir - Modifier";
                $menu['back'] = $this->back;
                $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
                $data['erreur'] = $erreur;
                $data['type_poste'] = $this->ressources_humaines_back_model->recupTypePoste();
                $data['poste'] = $this->ressources_humaines_back_model->recupPoste($id_poste);

                $this->load->view('back/include/menu.php', $menu);
                $this->load->view('back/ressources_humaines/gestion_postes/modifier-poste.php', $data);
            }
            else
            {                  
                $this->ressources_humaines_back_model->modifier_poste($id_poste, $type_poste, $titre, $accroche, $entreprise, $description, $date_debut_poste, $remuneration, $niveau);
                $this->session->set_flashdata('success', 'Poste modifié avec succès.');
                    Redirect('/ipssi/ressources-humaines/offre-poste');
            }
        }
    }

     public function ajouter_poste()
    {
        $menu['title'] = "IPSSI - Poste à pourvoir - Ajouter";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $data['droits'] = $this->droits;
        $data['type_poste'] = $this->ressources_humaines_back_model->recupTypePoste();
        
        $this->form_validation->set_rules('type_poste', '"Type de poste"', 'required');
        $this->form_validation->set_rules('titre', '"Titre"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('accroche', '"Accroche"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('description', '"Description"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('accroche', '"Accroche"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('date_debut', '"Date début de contrat"', 'required|date|encode_php_tags');
        $this->form_validation->set_rules('niveau', '"Niveau d\'expérience"', 'required|encode_php_tags');

        if($this->form_validation->run() == FALSE)
        {
            $menu['title'] = "IPSSI - Poste à pourvoir - Ajouter";
            $menu['back'] = $this->back;
            $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

            $data['success'] = $this->session->flashdata('success');
            $data['type_poste'] = $this->ressources_humaines_back_model->recupTypePoste();

            $this->load->view('back/include/menu.php', $menu);
            $this->load->view('back/ressources_humaines/gestion_postes/ajouter-poste.php', $data);
        }
        else
        {
            if(isset($erreur))
            {
                $data['erreur'] = $erreur;
                $this->load->view('back/include/menu.php', $menu);
                $this->load->view('back/ressources_humaines/gestion_postes/ajouter-poste.php', $data);
            }
            else
            {

                $erreur = '';

                $type_poste = $this->input->post('type_poste');
                $titre = $this->input->post('titre');
                $accroche = $this->input->post('accroche');
                $entreprise = $this->input->post('entreprise');
                $description = $this->input->post('description');
                $remuneration = $this->input->post('remuneration');
                $date_debut = $this->input->post('date_debut');
                $niveau_experience = $this->input->post('niveau');

                $id_insere = $this->ressources_humaines_back_model->ajouter_poste($type_poste, $titre, $accroche, $entreprise, $description, $remuneration, $date_debut, $niveau_experience);
                if($id_insere != '')
                {
                    $this->session->set_flashdata('success', 'Poste ajouté avec succès.');
                        Redirect('/ipssi/ressources-humaines/offre-poste/ajouter');    
                }
                else
                {
                    $data['erreur'] = 'Aucune modification effectuée.';
                    $this->load->view('back/include/menu.php', $menu);
                    $this->load->view('back/ressources_humaines/gestion_postes/ajouter-poste.php', $data);
                }   
            }
        }
    }

    /* --------------------------------------- */

    /* -------------------Candidatures -------------------- */

    public function candidatures()
    {
        $menu['title'] = "IPSSI - Candidatures";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
        $data['droits'] = $this->droits;
        $data['candidatures_spontannees'] = $this->ressources_humaines_back_model->recupCandidaturesSpontannees();
        $data['candidatures'] = $this->ressources_humaines_back_model->recupCandidatures();
       
        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/ressources_humaines/gestion_candidatures/liste-candidature.php', $data);
    }

    public function detail_candidatures($id_candidature = '')
    {

        if(($id_candidature == '') || (count($this->ressources_humaines_back_model->recupCandidature($id_candidature)) == 0))
            Redirect('/ipssi/ressources-humaines/candidatures');

        $menu['title'] = "IPSSI - Détail candidature";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
        $data['droits'] = $this->droits;
        $data['candidature'] = $this->ressources_humaines_back_model->recupCandidature($id_candidature);
        $data['poste'] = $this->ressources_humaines_back_model->recupPosteCandidature($id_candidature);
       
        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/ressources_humaines/gestion_candidatures/detail-candidature.php', $data);
    }

    public function supprimer_candidatures($id_candidature = '')
    {
        if(($id_candidature == '') || (count($this->ressources_humaines_back_model->recupCandidature($id_candidature)) == 0))
            Redirect('/ipssi/ressources-humaines/candidatures');

        $menu['title'] = "IPSSI - Candidature - Supprimer";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
        $data['droits'] = $this->droits;

        $this->ressources_humaines_back_model->supprimerCandidature($id_candidature);
        $this->session->set_flashdata('success', 'Candidature supprimée avec succès.');

        Redirect('/ipssi/ressources-humaines/candidatures');
    }

    /* --------------------------------------- */

    /* ----------------- Gestion des conges ---------------------- */
    
    public function liste_conges()
    {
        $menu['title'] = "IPSSI - Liste demandes de congés";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
        $data['droits'] = $this->droits;
        $data['congesPersonnels'] = $this->ressources_humaines_back_model->recupCongesPersonnels($this->session->userdata('id'));
        $data['conges'] = $this->ressources_humaines_back_model->recupConges($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/ressources_humaines/gestion_conges/liste-conges.php', $data);
    }

    public function detail_conges($id_conges = '')
    {
        $menu['title'] = "IPSSI - Détail demande de congés";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
        $data['droits'] = $this->droits;
        $data['conge'] = $this->ressources_humaines_back_model->recupConge($id_conges);
       
        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/ressources_humaines/gestion_conges/detail-conges.php', $data);
    }

    public function modifier_conges($id_conges = '')
    {
        if(($id_conges == '') || (count($this->ressources_humaines_back_model->recupConge($id_conges)) == 0))
            Redirect('/ipssi/ressources-humaines/liste-conges');


        $this->form_validation->set_rules('type_conges', '"Type de congés"', 'required');
        $this->form_validation->set_rules('etat', '"Etat de la demande"', 'required|encode_php_tags');
        $this->form_validation->set_rules('date_debut', '"Date de début de la demande"', 'required|date|encode_php_tags');
        $this->form_validation->set_rules('date_fin', '"Date de fin de la demande"', 'required|date|encode_php_tags');

            
        if($this->form_validation->run() == FALSE)
        {
            $menu['title'] = "IPSSI - Modification d'une demande de congés";
            $menu['back'] = $this->back;
            $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
            $data['droits'] = $this->droits;
            $data['conge'] = $this->ressources_humaines_back_model->recupConge($id_conges);
            $data['etat'] = $this->ressources_humaines_back_model->recupEtat();
            $data['type_conges'] = $this->ressources_humaines_back_model->recupTypeConges();
           
            $this->load->view('back/include/menu.php', $menu);
            $this->load->view('back/ressources_humaines/gestion_conges/modifier-conges.php', $data);
        }
        else
        {
            $erreur = '';

            $type_conges = $this->input->post('type_conges');
            $etat = $this->input->post('etat');
            $date_debut = $this->input->post('date_debut');
            $date_fin = $this->input->post('date_fin');
            $nb_jour = $this->input->post('nb_jour');
            
            if($erreur != '')
            {
                $menu['title'] = "IPSSI - Modification d'une demande de congés";
                $menu['back'] = $this->back;
                $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
                $data['droits'] = $this->droits;
                $data['conge'] = $this->ressources_humaines_back_model->recupConge($id_conges);
                $data['etat'] = $this->ressources_humaines_back_model->recupEtat();
                $data['type_conges'] = $this->ressources_humaines_back_model->recupTypeConges();
               
                $this->load->view('back/include/menu.php', $menu);
                $this->load->view('back/ressources_humaines/gestion_conges/modifier-conges.php', $data);
            }
            else
            {                  
                $this->ressources_humaines_back_model->modifier_conges($id_conges, $type_conges, $etat, $date_debut, $date_fin, $nb_jour);
                $this->session->set_flashdata('success', 'Poste modifié avec succès.');
                    Redirect('/ipssi/ressources-humaines/liste-conges');
            }
            
        }
    }

    public function valider_conges($id_conges = '')
    {
        if(($id_conges == '') || (count($this->ressources_humaines_back_model->recupConge($id_conges)) == 0))
            Redirect('/ipssi/ressources-humaines/liste-conges');

        $this->form_validation->set_rules('etat', '"Etat de la demande"', 'required|encode_php_tags');
            
        if($this->form_validation->run() == FALSE)
        {
            $menu['title'] = "IPSSI - Validation d'une demande de congés";
            $menu['back'] = $this->back;
            $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
            $data['droits'] = $this->droits;
            $data['conge'] = $this->ressources_humaines_back_model->recupConge($id_conges);
            $data['etat'] = $this->ressources_humaines_back_model->recupEtat();
           
            $this->load->view('back/include/menu.php', $menu);
            $this->load->view('back/ressources_humaines/gestion_conges/valider-conges.php', $data);
        }
        else
        {
            $erreur = '';

            $etat = $this->input->post('etat');
            
            if($erreur != '')
            {
                $menu['title'] = "IPSSI - Modification d'une demande de congés";
                $menu['back'] = $this->back;
                $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
                $data['droits'] = $this->droits;
                $data['conge'] = $this->ressources_humaines_back_model->recupConge($id_conges);
                $data['etat'] = $this->ressources_humaines_back_model->recupEtat();
                $data['type_conges'] = $this->ressources_humaines_back_model->recupTypeConges();
               
                $this->load->view('back/include/menu.php', $menu);
                $this->load->view('back/ressources_humaines/gestion_conges/valider-conges.php', $data);
            }
            else
            {                  
                $this->ressources_humaines_back_model->valider_conges($id_conges, $etat);
                $this->session->set_flashdata('success', 'Poste modifié avec succès.');
                    Redirect('/ipssi/ressources-humaines/liste-conges');
            }
            
        }
    }

    public function supprimer_conges($id_conges = '')
    {
        if(($id_conges == '') || (count($this->ressources_humaines_back_model->recupConge($id_conges)) == 0))
            Redirect('/ipssi/ressources-humaines/liste-conges');

        $menu['title'] = "IPSSI - Conges - Supprimer";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
        $data['droits'] = $this->droits;

        $this->ressources_humaines_back_model->supprimer_conges($id_conges);
        $this->session->set_flashdata('success', 'Demande de congés supprimée avec succès.');

        Redirect('/ipssi/ressources-humaines/liste-conges');
    }


     public function ajouter_conges()
    {
        $menu['title'] = "IPSSI - demande de congés - Ajouter";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $data['droits'] = $this->droits;
        $data['etat'] = $this->ressources_humaines_back_model->recupEtat();
        $data['type_conges'] = $this->ressources_humaines_back_model->recupTypeConges();
        
        
        $this->form_validation->set_rules('type_conges', '"Type de demande"', 'required');
        $this->form_validation->set_rules('date_debut', '"Date de début"', 'trim|required|encode_php_tags');
        $this->form_validation->set_rules('date_fin', '"Date de fin"', 'trim|required|encode_php_tags');

        if($this->form_validation->run() == FALSE)
        {
            $menu['title'] = "IPSSI - Demande de congés - Ajouter";
            $menu['back'] = $this->back;
            $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

            $data['success'] = $this->session->flashdata('success');

            $this->load->view('back/include/menu.php', $menu);
            $this->load->view('back/ressources_humaines/gestion_conges/ajouter-conges.php', $data);
        }
        else
        {
            if(isset($erreur))
            {
                $data['erreur'] = $erreur;
                $this->load->view('back/include/menu.php', $menu);
                $this->load->view('back/ressources_humaines/gestion_postes/ajouter-poste.php', $data);
            }
            else
            {

                $erreur = '';

                $type_conges = $this->input->post('type_conges');
                $date_debut = $this->input->post('date_debut');
                $date_fin = $this->input->post('date_fin');
                $nb_jour = $this->input->post('nb_jour');

                $id_insere = $this->ressources_humaines_back_model->ajouter_conges($type_conges, $date_debut, $date_fin, $nb_jour, $this->session->userdata('id'));
                if($id_insere != '')
                {
                    $this->session->set_flashdata('success', 'Demande de congés ajoutée avec succès.');
                        Redirect('/ipssi/ressources-humaines/liste-conges/ajouter');    
                }
                else
                {
                    $data['erreur'] = 'Aucune insertion effectuée.';
                    $this->load->view('back/include/menu.php', $menu);
                    $this->load->view('back/ressources_humaines/gestion_conges/ajouter-conges.php', $data);
                }   
            }
        }
    }



    /* --------------------------------------- */

    public function cvtheque()
    {
    	$menu['title'] = "IPSSI - CV-thèque";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
       
        $this->load->view('back/include/menu.php', $menu);
    }

    
}


?>
