<?php

class Contact extends CI_Controller
{	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('menu');
		$this->load->model('contact_model');
	}
	
	public function index()
	{
		$menu['title'] = "IPSSI : Institut Privée Supérieure des Systèmes d'Informations";
		$menu['menu'] = $this->menu->recupMenu();
		$menu['chargerGoogleMaps'] = true;
		
		$data['adresse'] = $this->contact_model->recupAdresse();
		$data['sexe'] = $this->contact_model->recupSexe();
		$data['contact_demande'] = $this->contact_model->recupContactDemande();
		$data['contact_type'] = $this->contact_model->recupContactType();
		$data['contact_message_envoye_ok'] = $this->session->flashdata('contact_message_envoye_ok');		
		
		$this->form_validation->set_rules('contact_type', '"Type de contrat"', 'trim|required|is_natural');
		$this->form_validation->set_rules('contact_demande', '"Sujet de la demande"', 'trim|required|is_natural');
		$this->form_validation->set_rules('sexe', '"Civilité"', 'trim|required|is_natural');
		$this->form_validation->set_rules('nom', '"nom"', 'trim|required|max_length[100]|alpha_dash');
		$this->form_validation->set_rules('prenom', '"prenom"', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('societe', '"societe"', 'trim|max_length[100]');
		$this->form_validation->set_rules('fonction', '"fonction"', 'trim|max_length[150]');
		$this->form_validation->set_rules('mail', '"mail"', 'trim|required|max_length[250]|valid_email');
		$this->form_validation->set_rules('telephone', '"telephone"', 'trim|integer|max_length[20]');
		$this->form_validation->set_rules('message', '"message"', 'trim|required|max_length[10000]');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('include/menu.php', $menu);
			$this->load->view('contact/contact.php', $data);
		}
		else
		{				
			$retour = $this->contact_model->inserer_contact($_POST['sexe'], $_POST['contact_type'], $_POST['contact_demande'], $_POST['nom'], $_POST['prenom'], $_POST['societe'], $_POST['fonction'],$_POST['mail'],$_POST['telephone'],$_POST['message']);
			if($retour != false)
			{
				$this->session->set_flashdata('contact_message_envoye_ok', 'Message envoyé avec succès. Une réponse vous sera apportée dans les meilleurs délais.');
				Redirect('/contact');
			}
			else
			{
				$data['erreur'] = "Erreur lors de l'insertion de votre message en base de données.";
				$this->load->view('include/menu.php', $menu);
				$this->load->view('contact/contact.php', $data);
			}
		}		
	}
}

?>