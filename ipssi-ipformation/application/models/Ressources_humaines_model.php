<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ressources_humaines_model extends CI_Model
{	
	protected $tablePoste = 'poste_candidature';
	protected $tableTypePoste = 'type_poste';
	protected $tableSexe = 'sexe';
	protected $tableTypeFormation = 'type_formation';
	protected $tableCandidature = 'candidature';
	protected $tableFormation = 'candidature_formation';
	
	public function recupPostes()
	{	
		$this->db->select('id_poste, titre_poste, accroche_poste, entreprise_poste, date_depot, description, date_debut_poste, remuneration_poste',true);
		$this->db->from($this->tablePoste);
		$this->db->where('supprime', 0);
		$this->db->order_by('date_depot DESC');
		
		$result = $this->db->get()->result();
		
		return $result;
	}
	
	public function recupPoste($id_poste)
	{
		$this->db->select('id_poste, titre_poste, accroche_poste, entreprise_poste, date_depot, description, date_debut_poste, remuneration_poste',true);
		$this->db->from($this->tablePoste);
		$this->db->where('id_poste',$id_poste);
		$this->db->where('supprime', 0);
		
		$result = $this->db->get()->result();
		
		return $result;
	}
	
	public function posteExiste($id_poste)
	{
		$this->db->select('id_poste');
		$this->db->from($this->tablePoste);
		$this->db->where('id_poste',$id_poste);
		
		return($this->db->get()->result()[0]->id_poste != '');
	}
	
	public function recupDetailPoste($id_poste)
	{
		$this->db->select('id_poste, titre_poste, accroche_poste, entreprise_poste, date_depot, description, date_debut_poste, remuneration_poste, libelle as type_poste, niveau_experience');
		$this->db->from($this->tablePoste);
		$this->db->join($this->tableTypePoste.' T', 'T.id_type_poste = '.$this->tablePoste.'.id_type_poste');
		$this->db->where('id_poste',$id_poste);
		$this->db->where('supprime', 0);
		
		$result = $this->db->get()->result()[0];
		
		return $result;
	}
	
	public function recupSexe()
	{
		$this->db->select('id_sexe,raccourci_sexe');
		$this->db->from($this->tableSexe);

		return $this->db->get()->result();
	}
	
	public function recupTypeFormation()
	{
		$this->db->select('id_type_formation, libelle');
		$this->db->from($this->tableTypeFormation);

		return $this->db->get()->result();
	}
	
	public function verifFormulaireCandidature()
	{
		$erreur='';

		$d = explode('/', $_POST['naissance']);
		if(count($d) == 3)
		{
			if(!checkdate($d[1], $d[0], $d[2]))
				$erreur = "La date de naissance saisie n'existe pas.";
			else
			{
				$timestampJour = mktime(0,0,0,date('m'),date('d'),date('Y'));
				$timestampSaisie = mktime(0,0,0,$d[1], $d[0], $d[2]);
				
				if($timestampSaisie >= $timestampJour)
					$erreur = "La date de naissance saisie est ultérieure ou égale à la date du jour.";
			}
		}
		else
			$erreur = "Veuillez renseigner votre date de naissance au format JJ/MM/AAAA.";

		return $erreur;
	}	
	
	public function inserer_candidature($sexe, $nom, $prenom, $naissance, $adresse, $cp, $ville, $pays, $telephone, $mail, $id, $code_aleatoire)
	{
		$tab = explode('/', $naissance);
		if(count($tab) == 3)
			$naissance = date($tab[2].'-'.$tab[1].'-'.$tab[0]);
		
		$this->db->set('id_sexe', $sexe);
		$this->db->set('nom_candidature', $nom);
		$this->db->set('prenom_candidature', $prenom);
		$this->db->set('date_naissance', $naissance);
		$this->db->set('adresse_candidature', $adresse);
		$this->db->set('cp_candidature', $cp);
		$this->db->set('ville_candidature', $ville);
		$this->db->set('pays_candidature', $pays);
		$this->db->set('email_candidature', $mail);
		$this->db->set('telephone_candidature', $telephone);
		$this->db->set('id_poste_candidature', $id);
		$this->db->set('cle', $code_aleatoire);
		
		$this->db->insert($this->tableCandidature);

		return $this->db->insert_id();
	}	
}

