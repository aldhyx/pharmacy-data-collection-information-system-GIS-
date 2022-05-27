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
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/login', 'Admin/Auth/LoginController::index', ['as' => 'login']);
$routes->post('/login', 'Admin/Auth/LoginController::login', ['as' => 'postLogin']);

$routes->group('admin', ['filter' => 'auth', 'namespace' => 'App\Controllers\Admin'], function ($routes) {
    $routes->get('/', 'HomeController::index', ['as' => 'adminHome']);
    $routes->group('profile', ['namespace' => 'App\Controllers\Admin\Auth'], function ($routes) {
        $routes->get('/', 'AdminController::index', ['as' => 'adminProfile']);
        $routes->post('/', 'AdminController::update', ['as' => 'adminProfileUpdate']);
        $routes->post('password', 'AdminController::updatePassword', ['as' => 'adminProfileUpdatePassword']);
        $routes->get('logout', 'LoginController::logout', ['as' => 'logout']);
    });

    $routes->get('pharmacies', 'PharmaciesController::index', ['as' => 'adminPharmacies']);
    $routes->post('pharmacies', 'PharmaciesController::store', ['as' => 'adminPharmaciesStore']);
    $routes->delete('pharmacies/(:num)', 'PharmaciesController::delete/$1', ['as' => 'adminPharmaciesDelete']);
    $routes->get('pharmacies/(:num)', 'PharmaciesController::update/$1', ['as' => 'adminPharmaciesUpdate']);
    $routes->get('pharmacies/create', 'PharmaciesController::create', ['as' => 'adminPharmaciesCreate']);
});
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
