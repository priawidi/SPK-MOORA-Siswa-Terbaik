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
//$routes->get('/', 'UserAuth::index');
// $routes->get('/', 'Home::index',['filter' => 'authGuard']);
$routes->get('/', 'AuthController::index');
$routes->get('/login', 'AuthController::index');
$routes->match(['get', 'post'], 'AuthController/loginAuth', 'AuthController::loginAuth');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/admin', 'AdminController::index', ['filter' => 'authGuard']);
$routes->get('/guru', 'GuruController::index', ['filter' => 'authGuard']);
$routes->get('/siswa', 'SiswaController::index', ['filter' => 'authGuard']);
//USER
$routes->get('/user', 'UserController::manajemen_user', ['filter' => ['authGuard', 'authAdmin']]);
$routes->match(['get', 'post'], '/adduser', 'UserController::add_user', ['filter' => ['authGuard', 'authAdmin']]);
$routes->match(['get', 'post'], '/deleteuser/(:num)', 'UserController::delete_user/$1', ['filter' => ['authGuard', 'authAdmin']]);
$routes->match(['get', 'post'], '/edituser/(:num)', 'UserController::edit_user/$1', ['filter' => ['authGuard', 'authAdmin']]);
$routes->get('/detailuser/(:num)', 'UserController::detail_user/$1', ['filter' => ['authGuard', 'authAdmin']]);
//SISWA
$routes->get('/datasiswa', 'SiswaController::data_siswa', ['filter' => ['authGuard', 'authGuru']]);
$routes->match(['get', 'post'], '/addsiswa', 'SiswaController::add_siswa', ['filter' => ['authGuard', 'authGuru']]);
$routes->match(['get', 'post'], '/deletesiswa/(:num)', 'SiswaController::delete_siswa/$1', ['filter' => ['authGuard', 'authGuru']]);
$routes->match(['get', 'post'], '/editsiswa/(:num)', 'SiswaController::edit_siswa/$1');
$routes->get('/detailsiswa/(:num)', 'SiswaController::detail_siswa/$1', ['filter' => ['authGuard', 'authGuru']]);
//KRITERIA
$routes->get('/kriteria', 'KriteriaController::kriteria', ['filter' => 'authGuard']);
$routes->match(['get', 'post'], '/addkriteria', 'KriteriaController::add_kriteria', ['filter' => 'authGuard']);
$routes->match(['get', 'post'], '/deletekriteria/(:num)', 'KriteriaController::delete_kriteria/$1', ['filter' => 'authGuard']);
$routes->match(['get', 'post'], '/editkriteria/(:num)', 'KriteriaController::edit_kriteria/$1');
$routes->get('/detailkriteria/(:num)', 'KriteriaController::detail_kriteria/$1', ['filter' => 'authGuard']);
//NILAI SISWA
$routes->get('/nilaisiswa', 'SiswaController::nilai_siswa', ['filter' => 'authGuard']);
$routes->match(['get', 'post'], '/addnilaisiswa/(:num)', 'SiswaController::add_nilai_siswa/$1', ['filter' => 'authGuard']);
$routes->match(['get', 'post'], '/deletenilaisiswa/(:num)', 'SiswaController::delete_nilai_siswa/$1', ['filter' => 'authGuard']);
$routes->match(['get', 'post'], '/editnilaisiswa/(:num)', 'SiswaController::edit_nilai_siswa/$1');
$routes->get('/detailnilaisiswa/(:num)', 'SiswaController::detail_nilai_siswa/$1', ['filter' => 'authGuard']);

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
