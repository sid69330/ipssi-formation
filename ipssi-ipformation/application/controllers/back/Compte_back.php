<?php

class Compte_back extends CI_Controller
{	
	private $back = true;

	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('menu');
		$this->load->library('form_validation');
		$this->load->model('back/compte_back_model');

		if(!$this->session->has_userdata('id'))
			Redirect();
	}

	public function index()
	{
		$menu['title'] = "IPSSI - Mon compte";
        $menu['back'] = $this->back;
        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

        $data['infos'] = $this->compte_back_model->recupInfosUtilisateur($this->session->userdata('id'));
		$data['error'] = $this->session->flashdata('error');
       
        $data['google'] = $this->associer_google();

        $this->load->view('back/include/menu.php', $menu);
        $this->load->view('back/compte/mon_compte_accueil.php', $data);
	}

	public function modifier_infos()
	{
		$menu['title'] = "IPSSI - Mon compte - Modifier mes informations personnelles";
		$menu['back'] = $this->back;
		$data['nav'] = 2;
		$menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
		
		$data['infos'] = $this->compte_back_model->recupInfosUtilisateur($this->session->userdata('id'));

		$this->form_validation->set_rules('tel', '"Téléphone"', 'trim|encode_php_tags|regex_match[/^0[0-9]{9}$/]');

		if($this->form_validation->run() == FALSE)
		{
			$data['success'] = $this->session->flashdata('success');
			$this->load->view('back/include/menu.php', $menu);
       		$this->load->view('back/compte/modifier_infos.php', $data);
		}
		else
		{
			$tel = $this->input->post('tel');

			$ok = $this->compte_back_model->maj_infos_utilisateur($this->session->userdata('id'), $tel, $data['infos']->telephone_utilisateur);

			if($ok)
			{
				$this->session->set_flashdata('success', 'Vos informations personnelles ont bien été mises à jour.');
				Redirect('ipssi/compte/modifier-infos');
			}
			else
			{
				$data['erreur'] = 'Une erreur est survenue pendant la mise à jour de vos informations personnelles.';
				$this->load->view('back/include/menu.php', $menu);
       			$this->load->view('back/compte/modifier_infos.php', $data);
			}
		}
	}

	public function modifier_photo_profil()
	{
		$menu['title'] = "IPSSI - Mon compte - Modifier ma photo de profil";
		$menu['back'] = $this->back;
		$menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
		
		$data['infos'] = $this->compte_back_model->recupInfosUtilisateur($this->session->userdata('id'));
		$data['nav'] = 1;
		$data['success'] = $this->session->flashdata('success');

		if(isset($_FILES['file']))
		{
			$erreur = '';
			if($_FILES['file']['name'] != '')
			{
				if($_FILES['file']['error'] == 0)
				{
					if ($_FILES['file']['size'] <= 1048576)
					{
						$infosfichier = pathinfo($_FILES['file']['name']);
						$extension_upload = strtolower($infosfichier['extension']);
						$extensions_autorisees = array('jpg', 'jpeg', 'png');

						if(in_array($extension_upload, $extensions_autorisees))
						{
							$image_info = getimagesize($_FILES['file']["tmp_name"]);
							$image_width = $image_info[0];
							$image_height = $image_info[1];

							if($image_width >= $image_height)
							{
								$grand_cote = $image_width;
								$petit_cote = $image_height;
							}
							else
							{
								$grand_cote = $image_height;
								$petit_cote = $image_width;
							}

							if(($grand_cote >= 250) && ($petit_cote >= 150))
							{
								$nomFichier = basename('photo-de-profil-de', '.'.$extension_upload).'-'.$this->session->userdata('nom').'-'.$this->session->userdata('prenom').'-'.time().'.'.$extension_upload;
								$nomFichier = mb_strtolower($nomFichier);

								$ok = $this->compte_back_model->majPhoto($nomFichier, $this->session->userdata('id'));

								if($ok)
								{
									if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/assets/images/profil/'.$this->session->userdata('id')))
										mkdir($_SERVER['DOCUMENT_ROOT'].'/assets/images/profil/'.$this->session->userdata('id'), 0755);

									$ok = move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/assets/images/profil/'.$this->session->userdata('id').'/'.$nomFichier);

									if($ok)
									{
										$this->load->library('image_lib');

										$config['image_library'] = 'gd2';
										$config['source_image'] = $_SERVER['DOCUMENT_ROOT'].'/assets/images/profil/'.$this->session->userdata('id').'/'.$nomFichier;
										$config['new_image'] = $_SERVER['DOCUMENT_ROOT'].'/assets/images/profil/'.$this->session->userdata('id').'/'.$nomFichier;
										$config['create_thumb'] = FALSE;
										$config['maintain_ratio'] = TRUE;
										
										if($image_width >= $image_height)
											$config['width'] = 200;
										else
											$config['height'] = 200;

										$this->image_lib->initialize($config);
										$this->image_lib->resize();

										if($data['infos']->photo_profil != '')
											unlink($_SERVER['DOCUMENT_ROOT'].'/assets/images/profil/'.$this->session->userdata('id').'/'.$data['infos']->photo_profil);

										$this->session->set_flashdata('success', 'Photo de profil modifiée avec succès.');
										Redirect('/ipssi/compte/modifier-photo-profil');
									}
									else
									{
										$this->compte_back_model->majPhoto(null, $this->session->userdata('id'));
										$erreur = 'Erreur lors de l\'ajout de la nouvelle photo de profil.';
									}
								}
								else
									$erreur = 'Erreur lors de l\'ajout de la nouvelle photo de profil.';
							}
							else
								$erreur = 'Veuillez sélectionner une photographie d\'au moins 250px x 150px (portrait ou paysage).';
						}
						else
							$erreur = 'Extension du fichier non autorisée. Veuillez séléctionner un fichier jpg, jpeg ou png.';
					}
					else
						$erreur = 'Fichier trop lourd : 1Mo maximum';
				}
				else
					$erreur = 'Erreur lors du transfert du fichier. Vérifiez votre connexion internet.';
			}
			else
				$erreur = 'Le champ "Photo de profil" est nécessaire.';

			if($erreur != '')
			{
				$data['erreur'] = $erreur;
				$this->load->view('back/include/menu.php', $menu);
       			$this->load->view('back/compte/modifier_photo_profil.php', $data);
			}
		}
		else
		{
			$this->load->view('back/include/menu.php', $menu);
       		$this->load->view('back/compte/modifier_photo_profil.php', $data);
		}
	}
	
	public function modifier_mdp()
	{
		$this->form_validation->set_rules('mdp_actuel', '"Mot de passe actuel"', 'trim|required|encode_php_tags');
		$this->form_validation->set_rules('mdp1', '"Nouveau mot de passe"', 'required|encode_php_tags|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[0-9])(?=.*\W).{8,}$/]');
		$this->form_validation->set_rules('mdp2', '"Ressaisir"', 'required|encode_php_tags|matches[mdp1]');

		$menu['title'] = "IPSSI - Mon compte - Modifier mon mot de passe";
		$menu['back'] = $this->back;
		$menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));
		$data['nav'] = 3;

		if($this->form_validation->run() == FALSE)
		{
	        $data['mdp_premiere_connexion'] = $this->session->flashdata('mdp_premiere_connexion');
	        $data['success'] = $this->session->flashdata('success');

	        $this->load->view('back/include/menu.php', $menu);
			$this->load->view('back/compte/modifier_mdp.php', $data);
		}
        else
        {
        	$mdp_actuel = hash('sha256', $this->input->post('mdp_actuel'));
        	$new_mdp = hash('sha256', $this->input->post('mdp1'));
        	
        	if($mdp_actuel != $new_mdp)
        	{
        		if($this->compte_back_model->mot_de_passe_actuel_correct($mdp_actuel, $this->session->userdata('id')))
	        	{
	        		$nbLigneModifiee = $this->compte_back_model->modifier_mot_de_passe($new_mdp, $this->session->userdata('id'));

	        		if($nbLigneModifiee == 1)
	        		{
	        			if($this->session->has_userdata('password_expire'))
	        				unset($this->session->userdata['password_expire']);
	        			
	        			$this->session->set_flashdata('success', 'Votre mot de passe a été modifié avec succès.');
	        			Redirect('ipssi/compte/modifier-mdp');
	        		}
	        		else
	        		{
	        			$data['erreur'] = 'Une erreur s\'est produite pendant la mise à jour du mot de passe.';

			       		$this->load->view('back/include/menu.php', $menu);
						$this->load->view('back/compte/modifier_mdp.php', $data);
	        		}
	        	}
	        	else
	        	{
			        $data['erreur'] = 'Votre mot de passe actuel est incorrect.';

			        $this->load->view('back/include/menu.php', $menu);
					$this->load->view('back/compte/modifier_mdp.php', $data);
	        	}
        	}
        	else
        	{
		        $data['erreur'] = 'Le nouveau mot de passe doit être différent du mot de passe actuel.';

		        $this->load->view('back/include/menu.php', $menu);
				$this->load->view('back/compte/modifier_mdp.php', $data);
        	}
        }
	}

	private function associer_google()
	{
		$return = array();

		require_once $_SERVER['DOCUMENT_ROOT'].'/assets/google-api-php-client-2.0.3/vendor/autoload.php';

		$client = new Google_Client();
		$client->setClientId('682182360339-8gffe5ukmk4edop89c9te6a55aode029.apps.googleusercontent.com');
		$client->setClientSecret('iwWRS_UHoSd2u8vmxMCkMwne');
		$client->addScope("https://www.googleapis.com/auth/userinfo.email");
		$redirect_uri = 'http://erp.dev.com/ipssi/compte';
		$client->setRedirectUri($redirect_uri);

		//$token = $this->compte_back_model->recupTokenGoogle($this->session->userdata('id'));
		$objOAuthService = new Google_Service_Oauth2($client);

		if(isset($_GET['logout']))
		{
			unset($_SESSION['access_token']);
			//$client->revokeToken();
			header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL)); //redirect user back to page
		}

		if(isset($_GET['code']))
		{
			$client->authenticate($_GET['code']);
			$_SESSION['access_token'] = $client->getAccessToken();

			header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
		}

		if(isset($_SESSION['access_token']) && $_SESSION['access_token'])
		{
			$client->setAccessToken($_SESSION['access_token']);
		}

		if($client->getAccessToken())
		{
			$client->setAccessToken($_SESSION['access_token']);//ajouté sans savoir si c'est utile. Si toujours une erreur -> retirer cette ligne
			$userData = $objOAuthService->userinfo->get();
			$return[1] = $userData;
			$_SESSION['access_token'] = $client->getAccessToken();

			$token = $client->getAccessToken()['access_token'];

			if($this->session->userdata('mail') != $userData['email'])
			{
				unset($_SESSION['access_token']);

				$this->session->set_flashdata('error', 'Veuillez vous connecter avec la même adresse email que celle de votre compte IPSSI.');
				Redirect('/ipssi/compte');
			}
			else
			{
				$this->compte_back_model->majTokenGoogle($this->session->userdata('id'), $token);
			}

			return $return;
		}
		else
		{
			$return[0] = $client->createAuthUrl();
			return $return;
		}
	}
}

?>
