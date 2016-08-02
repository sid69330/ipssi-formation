<?php

class Connexion extends CI_Controller
{	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('menu');
		$this->load->library('form_validation');
		$this->load->model('connexion_model');

		if($this->session->has_userdata('id'))
			Redirect();
	}
	
	public function index()
	{
		$this->form_validation->set_rules('identifiant', '"Identifiant"', 'trim|required|valid_email|encode_php_tags');
		$this->form_validation->set_rules('mdp', '"Mot de passe"', 'required|encode_php_tags');

		$menu['title'] = "Connexion à l'intranet";

		if($this->form_validation->run() != FALSE)
		{
			$identifiant = $this->input->post('identifiant');
			$mdp = hash('sha256', $this->input->post('mdp'));

			$erreur = $this->connexion_model->verifierIndentifiant($identifiant, $mdp);

			if($erreur == '')
			{
				$result = $this->connexion_model->recupInfosSession($identifiant);
				
				$this->session->set_userdata('id', $result->id_utilisateur);
				$this->session->set_userdata('nom', $result->nom_utilisateur);
				$this->session->set_userdata('prenom', $result->prenom_utilisateur);
				$this->session->set_userdata('mail', $result->mail_utilisateur);

				if($result->changer_password == 1)
					$this->session->set_userdata('password_expire', $result->changer_password);

				$monfichier = fopen($_SERVER["DOCUMENT_ROOT"].'application/logs/logs.txt', 'a');
				fputs($monfichier, $result->nom_utilisateur . " " . $result->prenom_utilisateur . " - " . $_SERVER['REMOTE_ADDR'] . " - ".date("Y-m-d H:i:s")."\n");
				fclose($monfichier);

				Redirect('/ipssi');
			}
			else
			{		
				$data['erreurConnexion'] = $erreur;
				$menu['menu'] = $this->menu->recupMenu();
				$this->load->view('include/menu.php', $menu);
				$this->load->view('connexion/connexion.php', $data);
			}
		}	
		else
		{
			$menu['menu'] = $this->menu->recupMenu();
			$this->load->view('include/menu.php', $menu);
			$this->load->view('connexion/connexion.php');
		}
	}	
}

?>
