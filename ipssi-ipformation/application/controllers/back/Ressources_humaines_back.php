<?php

class Ressources_humaines_back extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('menu');
        $this->load->model('back/ressources_humaines_back_model');
    }

    public function offre_poste()
    {
        
    }
}


?>
