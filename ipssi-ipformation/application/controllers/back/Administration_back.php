<?php

class Administration_back extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('menu');
        $this->load->model('back/ressources_humaines_back_model');
    }

    public function gestion_utilisateurs()
    {

    }

    public function application()
    {

    }

    public function redaction_pages()
    {

    }
}


?>
