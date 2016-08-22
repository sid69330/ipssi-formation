<?php

class Ressources_humaines extends CI_Controller
{	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('menu');
		$this->load->model('ressources_humaines_model');
	}
	
	public function candidater($idPoste='')
	{
		$menu['title'] = "Candidature spontanee";
		$menu['menu'] = $this->menu->recupMenu();
		$data['sexe'] = $this->ressources_humaines_model->recupSexe();
		$data['insertion_candidature_ok'] = $this->session->flashdata('insertion_candidature_ok');
		
		if($idPoste != '')
			$data['id'] = $idPoste;
		
		$this->form_validation->set_rules('sexe', '"Civilité"', 'trim|required|is_natural|encode_php_tags');
		$this->form_validation->set_rules('nom', '"Nom"', 'trim|required|max_length[100]|encode_php_tags');
		$this->form_validation->set_rules('prenom', '"Prénom"', 'trim|required|max_length[100]|encode_php_tags');
		$this->form_validation->set_rules('naissance', '"Date de naissance"', 'trim|required|exact_length[10]|encode_php_tags');
		$this->form_validation->set_rules('adresse', '"Adresse"', 'trim|required|max_length[250]|encode_php_tags');
		$this->form_validation->set_rules('cp', '"Code postal"', 'trim|required|max_length[10]|encode_php_tags');
		$this->form_validation->set_rules('ville', '"Ville"', 'trim|required|max_length[100]|encode_php_tags');
		$this->form_validation->set_rules('pays', '"Pays"', 'trim|required|max_length[100]|encode_php_tags');
		$this->form_validation->set_rules('telephone', '"Téléphone"', 'trim|required|max_length[20]|encode_php_tags');
		$this->form_validation->set_rules('mail', '"Email"', 'trim|required|max_length[250]|valid_email|encode_php_tags');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('include/menu.php', $menu);
			$this->load->view('ressources_humaines/candidature_spontanee.php',$data);
		}
		else
		{
			if($idPoste == '')
				$idPosteAInserer = null;
			else
				$idPosteAInserer = $idPoste;

			$erreur = $this->ressources_humaines_model->verifFormulaireCandidature();
			if(trim($erreur) == '')
			{
				$characts = 'abcdefghijklmnopqrstuvwxyz';
				$characts .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';	
				$characts .= '1234567890'; 
				$code_aleatoire = ''; 

				for($i=0; $i < 100; $i++)
				{
					$code_aleatoire .= substr($characts, rand()%(strlen($characts)),1); 
				}
				$retour = $this->ressources_humaines_model->inserer_candidature($_POST['sexe'], $_POST['nom'], $_POST['prenom'], $_POST['naissance'], $_POST['adresse'], $_POST['cp'], $_POST['ville'],$_POST['pays'],$_POST['telephone'],$_POST['mail'], $idPosteAInserer, $code_aleatoire);
				
				if($retour != false)
				{
					$this->session->set_flashdata('insertion_candidature_ok', 'Votre candidature a bien été prise en compte');
					if($idPoste != '')
						Redirect('/ressources_humaines/poste');
					else
						Redirect('/ressources_humaines/candidater');
				}
				else
				{
					$data['erreur'] = "Erreur lors de l'insertion de candidature en base de données.";
					$this->load->view('include/menu.php', $menu);
					$this->load->view('ressources_humaines/candidature_spontanee.php',$data);
				}
			}
			else
			{
				$data['erreur'] = $erreur;
				$this->load->view('include/menu.php', $menu);
				$this->load->view('ressources_humaines/candidature_spontanee.php',$data);
			}
		}		
	}
	
	public function poste()
	{
		$menu['title'] = "Postes à pourvoir";
		$menu['menu'] = $this->menu->recupMenu();
					
		$data['postes'] = $this->ressources_humaines_model->recupPostes();
					
		$this->load->view('include/menu.php', $menu);
		$this->load->view('ressources_humaines/poste.php', $data);
	}
	
	public function detail_poste($id = '')
	{
		if($id == '')
			Redirect('/ressources_humaines/poste');
		
		if($this->ressources_humaines_model->posteExiste($id))
		{
			$menu['title'] = "Détail du poste";
			$menu['menu'] = $this->menu->recupMenu();
			
			$data['detail'] = $this->ressources_humaines_model->recupDetailPoste($id);
			
			$this->load->view('include/menu.php', $menu);
			$this->load->view('ressources_humaines/detail_poste.php', $data);
		}
		else
			Redirect('/ressources_humaines/poste');
	}
}


?>
