<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/','UtilisateurController::index');
$routes->get('/profile', 'UtilisateurController::profile');
$routes->post('/util/insert', 'UtilisateurController::insert_util');
$routes->put('/util', 'UtilisateurController::store');
$routes->delete('/util/(:num)','UtilisateurController::delete/$1');
$routes->post('/util/update','UtilisateurController::update');
//user routes
$routes->post('/login','UtilisateurController::login');
//devis routes
$routes->get('/devis', 'DevisController::index');
$routes->get('/devis/add', 'DevisController::add');
$routes->get('/devis/(:num)', 'DevisController::update/$1');
$routes->post('/devis/insert','DevisController::insert');
$routes->put('/devis/insert','DevisController::update');
$routes->delete('/devis/(:num)','DevisController::delete/$1');
$routes->put('/devis/(:num)','DevisController::modify/$1');
$routes->get('/devis/select/(:num)','DevisController::select/$1');
//service routes
$routes->get('/service', 'ServiceController::index');
$routes->post('/service/insert','ServiceController::insert_service');
$routes->delete('/service/(:num)','ServiceController::delete/$1');
$routes->put('/service','ServiceController::store');
$routes->get('/service_all','ServiceController::select_all');
//serveur routes

//specification routes


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}