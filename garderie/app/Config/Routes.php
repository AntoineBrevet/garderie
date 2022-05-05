<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Utilisateurs::index');
$routes->get('professionnels', 'Professionnels::index');

$routes->get('payment-stripe', 'StripeController::index');
$routes->get('prosIndex', 'Professionnels::prosIndex');
$routes->match(['get', 'post'], 'utilisateursIndex', 'Utilisateurs::utilisateursIndex');
$routes->get('showEnfants', 'Utilisateurs::showEnfants');
$routes->get('showReservations', 'Utilisateurs::showReservations');
$routes->get('query', 'Utilisateurs::showQuery');
$routes->match(['get', 'post'],'utilisateursIndex', 'Utilisateurs::showSearchStart');
$routes->match(['get', 'post'],'utilisateursIndex', 'Utilisateurs::showSearchEnd');
$routes->match(['get', 'post'],'utilisateursIndex', 'Utilisateurs::showSearchBoth');
$routes->match(['get', 'post'],'messages/(:any)', 'Utilisateurs::messages/$1');
$routes->match(['get', 'post'],'messagesPros/(:any)', 'Professionnels::messagesPros/$1');





// Routes Model
$routes->match(['get', 'post'], 'inscription', 'Utilisateurs::inscription');
$routes->match(['get', 'post'], 'connexion', 'Utilisateurs::connexion');
$routes->match(['get', 'post'], 'inscriptionPros', 'Professionnels::inscriptionPros');
$routes->match(['get', 'post'], 'connexionPros', 'Professionnels::connexionPros');
$routes->match(['get', 'post'], 'create', 'Professionnels::create');
$routes->match(['get', 'post'], 'profilPros', 'Professionnels::profilPros');
$routes->get('deconnexion', 'Utilisateurs::deconnexion');
$routes->get('deconnexionPros', 'Professionnels::deconnexionPros');
$routes->get('singlePro/(:any)', 'Professionnels::singlePro/$1');
$routes->get('singleUser/(:any)', 'Utilisateurs::singleUser/$1');
$routes->match(['get', 'post'],'singleSession/(:any)', 'Utilisateurs::singleSession/$1');
$routes->get('contactPros', 'Professionnels::contactPros');





$routes->match(['get', 'post'], 'createEnfants', 'Utilisateurs::createEnfants');
$routes->match(['get', 'post'], 'updateEnfants/(:any)', 'Utilisateurs::updateEnfants/$1');
$routes->get('deleteEnfants/(:any)', 'Utilisateurs::deleteEnfants/$1');
$routes->match(['get', 'post'], 'profil', 'Utilisateurs::modifProfil');



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
