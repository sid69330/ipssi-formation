<?php

class Actualites_back extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('menu');
        $this->load->model('back/ressources_humaines_back_model');
    }

    public function liste_actualites()
    {
        
    }
}

?>
