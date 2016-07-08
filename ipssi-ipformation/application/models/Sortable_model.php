<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sortable_model extends CI_Model
{	
	public function recup_classement_user($uid_config)
	{
		$this->db->select('uid, uid_config, id_dossier, type_dossier, ordre');
		$this->db->from('sortable');
		$this->db->where('uid_config', $uid_config);
		$this->db->order_by('ordre');
		
		return $this->db->get()->result();
	}
	
	public function supprimer_classement_user($uid_config)
	{
		$this->db->delete('sortable', array('uid_config' => $uid_config));
	}
	
	public function inserer_classement_user($uid_config, $tab_classement, $nom_dossier_divers)
	{
		foreach($tab_classement as $key => $value)
		{
			$ordre = $key+1;
			$id_dossier = $value;
			
			switch($id_dossier)
			{
				case 0:
					$type_dossier= "DOSSIER_CLIENT";
					break;
				case 1:
					$type_dossier= "ANNEE";
					break;
				case 2:
					$type_dossier= "MOIS";
					break;
				case 3:
					$type_dossier= "JOUR";
					break;
				case 4:
					$type_dossier= "SUJET_MAIL";
					break;
				case 5:
					if($nom_dossier_divers) 
						$type_dossier = str_replace('.', '_', preg_replace('/([^.a-z0-9]+)/i', '_', $nom_dossier_divers));
					else 
						$type_dossier="DIVERS";
					break;
			}
			
			$data = array
			(
			   'uid_config' => $uid_config,
			   'id_dossier' => $id_dossier,
			   'type_dossier' => $type_dossier,
			   'ordre' => $ordre
			);
			$this->db->insert('sortable', $data);
		}
	}
}