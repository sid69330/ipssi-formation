<?php

class Sortable extends CI_Controller
{	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('sortable_model');
	}
	
	public function index()
	{
		$uid_config = 1; //A modifier par la valeur souhaitée.
		$data['classement'] = $this->sortable_model->recup_classement_user($uid_config);
		$this->load->view('sortable.php', $data);
	}
	
	public function majOrdreBdd()
	{
		if(isset($_POST['divers']) && isset($_POST['uid_config']) && isset($_POST['type_classement']))
		{
			$this->sortable_model->supprimer_classement_user($_POST['uid_config']);
			if(isset($_POST['tab']))
			{
				$this->sortable_model->inserer_classement_user($_POST['uid_config'], $_POST['tab'], $_POST['divers']);
			}				
			echo 'Classement mis à jour avec succès.';
		}
		else
			echo '0';
	}
}

?>
