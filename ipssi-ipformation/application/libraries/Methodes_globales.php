<?php

class Methodes_globales
{	
	private $ci;
	
	public function __construct()
	{
		$this->ci = $CI = &get_instance();
	}

	public function recup_sexe()
	{
		$this->ci->db->select('id_sexe, raccourci_sexe, sexe');
		$this->ci->db->from('sexe');

		return $this->ci->db->get()->result();
	}

	public function groupe_existe($id_groupe)
	{
		$this->ci->db->select('id_groupe');
		$this->ci->db->from('groupe');

		return $this->ci->db->count_all_results();
	}

	public function recup_groupe()
	{
		$this->ci->db->select('id_groupe, libelle_groupe');
		$this->ci->db->from('groupe');
		$this->ci->db->order_by('ordre', 'desc');

		return $this->ci->db->get()->result();
	}
}