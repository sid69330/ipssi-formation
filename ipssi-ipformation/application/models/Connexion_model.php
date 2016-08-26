<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connexion_model extends CI_Model
{	
	public function verifierIndentifiant($identifiant, $mdp)
	{
		$erreur = '';
		
		$this->db->select('COUNT(*) as nb');
		$this->db->from('utilisateur');
		$this->db->where('mdp_utilisateur', $mdp);
		$this->db->where('mail_utilisateur', $identifiant);
		$this->db->where('supprime', 0);
		
		$nb = $this->db->get()->result()[0]->nb;

		if($nb == 0)
			$erreur = "Identifiant ou mot de passe incorrect.";
		elseif($nb != 1)
			$erreur = "Problème avec votre compte : duplicata de l'identifiant en base de données.";
		
		return $erreur;
	}
	
	public function recupInfosSession($identifiant)
	{
		$this->db->select('id_utilisateur, mail_utilisateur, nom_utilisateur, prenom_utilisateur, CASE WHEN DATE_ADD(date_mdp_utilisateur, INTERVAL 3 MONTH) > Now() THEN 0 ELSE 1 END as changer_password');
		$this->db->from('utilisateur');
		$this->db->where('mail_utilisateur', $identifiant);

		$result = $this->db->get()->result();

		return $result[0];
	}

	public function genererCleMdp($email, $code_aleatoire)
	{
		$data = array
		(
	        'cle_mdp_utilisateur' => $code_aleatoire
		);

		$this->db->where('mail_utilisateur', $email);
		$this->db->update('utilisateur', $data);

		return $this->db->affected_rows();
	}

	public function recup_infos_cle_mdp($cle)
	{
		$this->db->select('id_utilisateur');
		$this->db->from('utilisateur');
		$this->db->where('cle_mdp_utilisateur', $cle);

		return($this->db->get()->result());
	}

	public function reinitialiser_mdp($id_utilisateur, $mdp)
	{
		$data = array
        (
            'mdp_utilisateur' => $mdp
        );

        $this->db->set('date_mdp_utilisateur', 'NOW()', FALSE);
        $this->db->where('id_utilisateur', $id_utilisateur);
        $this->db->update('utilisateur', $data);

        return $this->db->affected_rows();
	}
}