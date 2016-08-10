<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_model extends CI_Model
{
	protected $tableActualite = "actualite";
	protected $tableMenu = "menu";
	protected $tableSousMenu = "sous_menu";
	protected $tablePage = "page_contenu";
	
	public function recupActualites()
	{	
		$this->db->select('id_actualite, titre_actualite, actualite, date_validite, url_photo_actualite');
		$this->db->from($this->tableActualite);
		$this->db->where('date_validite >', 'NOW()',false);
		$this->db->order_by('date_creation','desc');
		$this->db->limit(5);
		
		$result = $this->db->get()->result();
		
		return $result;
	}
	
	public function pageExiste($menu, $sous_menu)
	{	
		if($sous_menu != '')
			$this->db->select('count(*) as nb, SM.id_sous_menu, M.id_menu');
		else
			$this->db->select('count(*) as nb, null AS id_sous_menu, M.id_menu');
				
		$this->db->from($this->tableMenu.' M');
		
		if($sous_menu != '')
		{
			$this->db->join($this->tableSousMenu.' SM', 'SM.id_menu = M.id_menu');
			$this->db->where('SM.url_sous_menu', $sous_menu);
		}
		$this->db->where('url_menu', $menu);
		
		return($this->db->get()->result());
	}
	
	public function recupInfosPage($menu, $sous_menu)
	{
		$this->db->select('id_page_contenu, texte_page_contenu');
		$this->db->from($this->tablePage.' P');
		
		if($sous_menu != '')
		{
			$this->db->where('P.id_menu', $menu);
			$this->db->where('P.id_sous_menu', $sous_menu);
		}
		else
		{
			$this->db->where('P.id_menu', $menu);
			$this->db->where('P.id_sous_menu', null);
		}
		
		$result = $this->db->get()->result();
		
		if(count($result) == 1)
			return $result[0];
		else
		{
			$result = new stdClass();
			$result->titre_page_contenu = 'Veuillez renseigner un titre pour cette page';
			$result->texte_page_contenu = 'Veuillez renseigner un contenu cette page';
			
			return $result;
		}			
	}
}