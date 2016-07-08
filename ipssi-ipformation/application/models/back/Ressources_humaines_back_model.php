<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ressources_humaines_back_model extends CI_Model
{
    protected $tableActualite = "actualite";

    public function recupActualites($idActualite="")
    {
        $this->db->select('id_actualite, titre_actualite, texte_actualite, date_validite_actualite, url_photo_actualite');
        $this->db->from($this->tableActualite);
        $this->db->where('date_validite_actualite >= NOW()');

        if($idActualite!= '') {
            $this->db->where('id_actualite', $idActualite);
            $result = $this->db->get()->result()[0];
        }
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