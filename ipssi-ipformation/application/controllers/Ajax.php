<?php

class Ajax extends CI_Controller
{	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function recupSousMenu()
	{
		if(isset($_POST['menuSaisie']))
		{
			$retour = '';
			$this->db->select('id_sous_menu, libelle_sous_menu');
			$this->db->from('sous_menu');
			$this->db->where('id_menu', $_POST['menuSaisie']);
			
			$result = $this->db->get()->result();
			
			if(count($result) > 0)
			{
				$retour .= '<div class="form-group">';
					$retour .= '<label class="col-md-4 control-label" for="sousMenuSaisie">Choisir un sous-menu</label>';
					$retour .= '<div class="col-md-4">';
						$retour .= '<select id="sousMenuSaisie" name="sousMenuSaisie" class="form-control">';
							$retour .= '<option value="0">Choisir un sous menu</option>';
							foreach($result as $r)
							{
								$retour .= '<option value="'.$r->id_sous_menu.'">'.$r->libelle_sous_menu.'</option>';
							}
						$retour .= '</select>';
					$retour .= '</div>';
				$retour .= '</div>';
				echo $retour;
			}
			else
				echo null;
		}
		else
			echo 'Erreur : aucune donnée reçue';
	}
}

?>
