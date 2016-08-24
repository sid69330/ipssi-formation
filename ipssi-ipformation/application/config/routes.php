<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'page/index';
$route['page/(.+)/(.+)'] = 'page/afficher/$1/$2';

/* ------------------------------ Back ------------------------------ */
/* ----------- Accueil_back ----------- */
$route['ipssi'] = 'back/accueil';
/* ----------- Compte_back ----------- */
$route['ipssi/compte'] = 'back/compte_back/index';
$route['ipssi/compte/modifier-mdp'] = 'back/compte_back/modifier_mdp';
$route['ipssi/compte/modifier-photo-profil'] = 'back/compte_back/modifier_photo_profil';
$route['ipssi/compte/modifier-infos'] = 'back/compte_back/modifier_infos';
/* ----------- Actualite_back ----------- */
$route['ipssi/actualites/gestion-actualites'] = 'back/actualites_back/gestion_actualites';
$route['ipssi/actualites/gestion-actualites/ajouter'] = 'back/actualites_back/ajouter_actualite';
$route['ipssi/actualites/gestion-actualites/supprimer/(:num)'] = 'back/actualites_back/supprimer_actualite/$1';
$route['ipssi/actualites/gestion-actualites/detail/(:num)'] = 'back/actualites_back/detail_actualite/$1';
$route['ipssi/actualites/gestion-actualites/modifier/(:num)'] = 'back/actualites_back/modifier_actualite/$1';
/* ----------- RH_back ----------- */
$route['ipssi/ressources-humaines/cra'] = 'back/ressources_humaines_back/cra';
$route['ipssi/ressources-humaines/note-frais'] = 'back/ressources_humaines_back/note_frais';
$route['ipssi/ressources-humaines/demande-conges'] = 'back/ressources_humaines_back/demande_conges';
$route['ipssi/ressources-humaines/cvtheque'] = 'back/ressources_humaines_back/cvtheque';
$route['ipssi/ressources-humaines/offre-poste'] = 'back/ressources_humaines_back/offre_poste';
$route['ipssi/ressources-humaines/candidatures'] = 'back/ressources_humaines_back/candidatures';
$route['ipssi/ressources-humaines/collaborateurs'] = 'back/ressources_humaines_back/collaborateurs';
/* ----------- BAO_back ----------- */
$route['ipssi/boite-a-outils/certifications'] = 'back/boite_a_outils_back/certifications';
$route['ipssi/boite-a-outils/documents-travail'] = 'back/boite_a_outils_back/documents_travail';
/* ----------- Parametrage_back ----------- */
$route['ipssi/parametrage/rh'] = 'back/parametrage_back/rh';
$route['ipssi/parametrage/crm'] = 'back/parametrage_back/crm';
/* ----------- Administration_back ----------- */
$route['ipssi/administration/gestion-utilisateurs'] = 'back/administration_back/gestion_utilisateurs';
$route['ipssi/administration/gestion-utilisateurs/detail/(:num)'] = 'back/administration_back/detail_utilisateur/$1';
$route['ipssi/administration/gestion-utilisateurs/ajouter'] = 'back/administration_back/ajouter';
$route['ipssi/administration/gestion-utilisateurs/modifier/(:num)'] = 'back/administration_back/modifier_utilisateur/$1';
$route['ipssi/administration/gestion-utilisateurs/supprimer/(:num)'] = 'back/administration_back/supprimer_utilisateur/$1';
$route['ipssi/administration/application'] = 'back/administration_back/application';

$route['ipssi/administration/redaction-pages'] = 'back/administration_back/redaction_pages';
$route['ipssi/administration/redaction-pages/detail/(.+)/(.+)'] = 'back/administration_back/detail_redaction_pages/$1/$2';
$route['ipssi/administration/redaction-pages/detail/(.+)'] = 'back/administration_back/detail_redaction_pages/$1';
$route['ipssi/administration/redaction-pages/modifier/(.+)/(.+)'] = 'back/administration_back/modifier_redaction_pages/$1/$2';
$route['ipssi/administration/redaction-pages/modifier/(.+)'] = 'back/administration_back/modifier_redaction_pages/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;