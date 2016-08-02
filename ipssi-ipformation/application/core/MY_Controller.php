<?php

class MY_Controller extends CI_Controller
{
    private $back = true;

    public function __construct()
    {
        parent::__construct();

        $this->load->library('droit');

        if($this->session->userdata['id'] == '')
            Redirect();
        if($this->droit->doitModifierMotDePasse($this->session->userdata['id']))
        {
            $this->session->set_flashdata('mdp_premiere_connexion', 'Vous vous connectez pour la première fois. Merci de choisir un nouveau mot de passe. Il restera valide 3 mois.');
            Redirect('ipssi/compte/modifier-mdp', $data);
        }
        else
        {
            $url = explode('/', uri_string());

            if(count($url) > 0)
            {
                if(count($url) >= 3)
                     $module = $url[2];
                else
                    $module = array_pop($url);

                unset($url);
            }
            else
            {
                echo 'erreur controlleur droit';
                exit();
            }

            
            $droits = $this->droit->recupDroit($module, $this->session->userdata['id']);

            /* Si pas le droit sur la page courante */
            if(($droits !== true) && ((!is_array($droits)) || (count($droits) == 0)))
            {
                $this->load->library('menu');

                $menu['title'] = "IPSSI - Accès interdit";
                $menu['back'] = $this->back;
                $menu['menu'] = $this->menu->recupMenuBack($this->session->userdata('id'));

                $this->load->view('back/include/menu.php', $menu);
                $this->load->view('errors/back/droit_insuffisant.php');
            }
        }
    }
}

?>
