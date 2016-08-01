<?php

class MY_Controller extends CI_Controller
{
    private $back = true;

    public function __construct()
    {
        parent::__construct();

        if($this->session->userdata['id'] == '')
            Redirect();

        $url = explode('/', uri_string());

        if(count($url) > 0)
        {
            if(count($url) >= 3)
                 $module = $url[2];
            else
                $module = array_pop($url);
            
            //echo $module;

            unset($url);
        }
        else
        {
            echo 'erreur controlleur droit';
            exit();
        }

        $this->load->library('droit');
        $droits = $this->droit->recupDroit($module, $this->session->userdata['id']);

        //print_r($droits);

        if(($droits !== true) && ((!is_array($droits)) || (count($droits) == 0)))
        {
            $this->load->library('menu');

            $menu['title'] = "IPSSI - Accueil mon IPSSI";
            $menu['back'] = $this->back;
            $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

            $this->load->view('back/include/menu.php', $menu);
            $this->load->view('errors/back/droit_insuffisant.php');
        }
    }
}

?>
