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
		$this->form_validation->set_rules('identifiant', '"Email"', 'trim|required|valid_email|encode_php_tags');
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

	public function mot_de_passe_oublie()
	{
		$this->form_validation->set_rules('identifiant', '"Email"', 'trim|required|valid_email|is_exist[utilisateur.mail_utilisateur]|encode_php_tags');

		if($this->form_validation->run() == FALSE)
		{
			$menu['title'] = "Connexion à l'intranet";
			$menu['menu'] = $this->menu->recupMenu();

			$data['success'] = $this->session->flashdata('success');

			$this->load->view('include/menu.php', $menu);
			$this->load->view('connexion/mot-de-passe-oublie.php', $data);
		}
		else
		{
			$email = $this->input->post('identifiant');

			$characts = 'abcdefghijklmnopqrstuvwxyz';
			$characts .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';	
			$characts .= '1234567890'; 
			$code_aleatoire = ''; 

			for($i=0; $i < 100; $i++)
			{ 
				$code_aleatoire .= substr($characts, rand()%(strlen($characts)),1); 
			}

			$this->db->trans_start();

			$ok = $this->connexion_model->genererCleMdp($email, $code_aleatoire);

			if($ok)
			{
				$this->db->trans_complete();
				$this->load->library('envoi_mail');

				$body = 'Bonjour, <br/><br/>';
				$body .= 'Pour modifier votre mot de passe merci de cliquer ici : <a href="'.site_url('/connexion/modifier_mdp/'.$code_aleatoire).'">Réinitialiser mon mot de passe</a><br/><br/>';
				$body .= 'L\'équipe IPSSI';
				$this->envoi_mail->envoyer_email($email, 'Réinitialisation du mot de passe', $body);

				$this->session->set_flashdata('success', 'Un email vous a été envoyé contenant un lien permettant de réinitialiser votre mot de passe.');
                Redirect('/connexion/mot_de_passe_oublie');
			}
			else
			{
				$this->db->trans_rollback();

				$menu['title'] = "Connexion à l'intranet";
				$menu['menu'] = $this->menu->recupMenu();
				$data['erreur'] = 'Une erreur s\'est produite pendant la mise à jour de votre compte';

				$this->load->view('include/menu.php', $menu);
				$this->load->view('connexion/mot-de-passe-oublie.php', $data);
			}
		}
	}
}

?>
