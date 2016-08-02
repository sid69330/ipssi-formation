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
       
        $this->load->view('back/include/menu.php', $menu);
	}
	
	public function modifier_mdp()
	{
		$this->form_validation->set_rules('mdp_actuel', '"Mot de passe actuel"', 'trim|required|encode_php_tags');
		$this->form_validation->set_rules('mdp1', '"Nouveau mot de passe"', 'required|encode_php_tags|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[0-9])(?=.*\W).{8,}$/]');
		$this->form_validation->set_rules('mdp2', '"Ressaisir"', 'required|encode_php_tags|matches[mdp1]');

		if($this->form_validation->run() == FALSE)
		{
			$menu['title'] = "IPSSI - Mon compte - Modifier mon mot de passe";
	        $menu['back'] = $this->back;
	        $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

	        $data['mdp_premiere_connexion'] = $this->session->flashdata('mdp_premiere_connexion');
	        $data['success'] = $this->session->flashdata('success');

	        $this->load->view('back/include/menu.php', $menu);
			$this->load->view('back/compte/modifier_mdp.php', $data);
		}
        else
        {
        	$menu['title'] = "IPSSI - Mon compte - Modifier mon mot de passe";
			$menu['back'] = $this->back;
			$menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

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
}

?>
