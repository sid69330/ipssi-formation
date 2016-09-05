<?php

class MY_Controller extends CI_Controller
{
    private $back = true;
    private $droits = array();

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
        elseif($this->session->has_userdata('password_expire'))
        {
            $this->session->set_flashdata('mdp_premiere_connexion', 'Votre mot de passe a expiré. Merci d\'en saisir un nouveau. Il restera valide 3 mois.');
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

            $this->droits = $this->droit->recupDroit($module, $this->session->userdata['id']);

            //print_r($this->droits);

            /* Si pas le droit sur la page courante */
            if(($this->droits !== true) && ((!is_array($this->droits)) || (count($this->droits) == 0)))
            {
                $this->session->set_flashdata('droit_insuffisant', 'Vous ne possédez pas les droits nécessaires pour accéder à la page demandée. Vous avez été redirigé vers votre dashboard.');
                //Redirect('/ipssi');
            }
        }
    }

    public function getDroits()
    {
        return $this->droits;
    }
}

?>
