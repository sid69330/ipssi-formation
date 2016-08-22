<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_model extends CI_Model
{	
	protected $tableAdresse = "adresse";
	protected $tableSexe = 'sexe';
	protected $tableContact = 'contact';
	protected $tableContactType = 'contact_type';
	protected $tableContactDemande = 'contact_demande';
	
	public function recupAdresse()
	{	
		$this->db->select('libelle_adresse, numero_adresse, adresse_adresse, supplement_adresse, code_postal_adresse, ville_adresse, pays_adresse, telephone_adresse, fax_adresse');
		$this->db->from($this->tableAdresse);
		$result = $this->db->get()->result();
		
		return $result;
	}
		
	public function recupSexe()
	{
		$this->db->select('id_sexe,raccourci_sexe');
		$this->db->from($this->tableSexe);

		return $this->db->get()->result();
	}
	
	public function recupContactType()
	{
		$this->db->select('id_contact_type, libelle_contact_type');
		$this->db->from($this->tableContactType);

		return $this->db->get()->result();
	}
	
	public function recupContactDemande()
	{
		$this->db->select('id_contact_demande, libelle_contact_demande');
		$this->db->from($this->tableContactDemande);

		return $this->db->get()->result();

	}
	
	public function inserer_contact($sexe,$contact_type, $contact_demande, $nom, $prenom, $societe, $fonction,$mail,$telephone,$message)
	{
		$this->db->set('id_sexe', $sexe);
		$this->db->set('id_contact_type', $contact_type);
		$this->db->set('id_contact_demande', $contact_demande);
		$this->db->set('nom_contact', strtoupper($nom));
		$this->db->set('prenom_contact', ucfirst(strtolower($prenom)));
		$this->db->set('societe_contact', ucfirst(strtolower($societe)));
		$this->db->set('fonction_contact', $fonction);
		$this->db->set('email_contact', strtolower($mail));
		$this->db->set('telephone_contact', $telephone);
		$this->db->set('message_contact', $message);
		
		return $this->db->insert($this->tableContact);
		
	}
}