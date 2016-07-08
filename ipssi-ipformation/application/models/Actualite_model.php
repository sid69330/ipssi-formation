<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actualite_model extends CI_Model
{	
	protected $tableActualite = "actualite";
	
	public function recupActualites($idActualite="", $limite = '', $all = false)
	{	
		$this->db->select
		(
			'CASE WHEN date_validite_actualite >= NOW() THEN "En ligne" ELSE "Date validité dépassée" END AS etat, 
			DATE_FORMAT(date_actualite, "%d/%m/%Y %H:%i") AS date_actualite, 
			id_actualite, 
			titre_actualite, 
			texte_actualite, 
			date_validite_actualite, 
			url_photo_actualite'
		);
		$this->db->from($this->tableActualite);

		if($all == false)
			$this->db->where('date_validite_actualite >= NOW()');

		if($idActualite!= '')
			$this->db->where('id_actualite', $idActualite);

		if($limite != '')
			$this->db->limit($limite);

		$this->db->order_by('date_actualite desc');

		if($idActualite!= '')
			$result = $this->db->get()->result()[0];
		else
			$result = $this->db->get()->result();

		return $result;
	}

	public function actualiteExiste($id_actualite)
	{
		$this->db->select('count(id_actualite) as nbActualite');
		$this->db->from($this->tableActualite);
		$this->db->where('id_actualite', $id_actualite);
		$this->db->where('date_validite_actualite >= NOW()');

		return $this->db->get()->result()[0]->nbActualite;
	}
}