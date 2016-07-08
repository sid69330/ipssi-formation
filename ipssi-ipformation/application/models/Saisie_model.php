<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Saisie_model extends CI_Model
{	
	protected $tablePageContenu = "page_contenu";
	
	public function recupMenu($idActualite)
	{	
		$this->db->select('id_actualite, titre_actualite, actualite, date_validite, url_photo_actualite');
		$this->db->from($this->tableActualite);
		$this->db->where('id_actualite', $idActualite);
		
		$result = $this->db->get()->result()[0];
		
		return $result;
	}
	
}