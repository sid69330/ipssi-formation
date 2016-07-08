<?php

class Deconnexion extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!$this->session->has_userdata('id'))
            Redirect();
    }

    public function index()
    {
        session_destroy();
        Redirect();
    }
}

?>
