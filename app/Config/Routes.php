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
$routes->get('/', 'Home::index');
$routes->get('login','Home::login');
$routes->get('register','Home::register');
$routes->get('success','Home::successPage');
$routes->get('blog/(:any)','Home::readBlog/$1');
//customer registration/login/forgot_password
$routes->post('sign-in','Home::customerLogin');
$routes->post('create-account','Home::createAccount');
$routes->get('activate/(:any)','Home::activate/$1');
$routes->get('forgot-password','Home::forgotPassword');
$routes->get('authentication-new-password','Home::newAuthPassword');
$routes->get('sign-out','Home::signOut');
$routes->post('update-password','Home::updatePassword');
$routes->post('save','Customer::Save');
$routes->post('send-inquiry','Home::sendInquiry');
//admin
$routes->post('check','Home::check');
$routes->get('logout','Home::logout');
$routes->post('change-password','Home::updatePassword');
$routes->post('update-account','Home::updateAccount');
$routes->post('save-account','Home::saveAccount');
$routes->post('reset-account','Home::resetAccount');
$routes->get('reservation','Home::Reservation');
$routes->get('search-reservation','Home::searchReservation');
$routes->post('accept-reservation','Home::acceptReservation');
$routes->post('complete-reservation','Home::completeReservation');
$routes->get('view-message','Home::viewMessage');
$routes->post('deactivate-account','Home::deactivateAccount');
$routes->post('activate-account','Home::activateAccount');
$routes->post('rebook','Home::rebook');
//function
$routes->post('save-poll','ManageController::savePoll');
$routes->post('update-poll','ManageController::updatePoll');
$routes->post('close','ManageController::closeSurvey');
$routes->post('activate','ManageController::activateSurvey');
$routes->post('save-question','ManageController::saveQuestion');
$routes->post('delete-question','ManageController::deleteQuestion');
$routes->post('save-blog','ManageController::saveBlog');
$routes->post('update-blog','ManageController::updateBlog');
$routes->post('save-entry','ManageController::saveEntry');
$routes->post('edit-entry','ManageController::editEntry');
$routes->post('save-answer','ManageController::saveAnswer');
$routes->post('edit-answer','ManageController::editAnswer');
$routes->get('generate-reports','Report::generateReport');
$routes->get('respondents-location','Report::generateLocation');
$routes->get('age-chart','Report::ageChart');
$routes->get('respondents-answer','Report::answers');
$routes->get('high-risk','Report::highRisk');
$routes->get('download','Download::downloadFile');
$routes->post('restore','RestoreDB::RestoreData');
//customer controller
$routes->post('update-information','Customer::updateInformation');
$routes->post('cancel-reservation','Customer::cancelReservation');
$routes->get('get-available-time','Customer::getTime');
$routes->post('save-record','Customer::saveRecord');
$routes->post('reset-password','Customer::resetPassword');
$routes->post('change-pass','Customer::changePassword');
$routes->post('request-new-password','Home::requestNewPassword');

$routes->group('',['filter'=>'AuthCheck'],function($routes)
{
    $routes->get('admin/dashboard','Home::Dashboard');
    $routes->get('admin/manage','Home::Manage');
    $routes->get('admin/new-reservation','Home::newReservation');
    $routes->get('admin/reschedule/(:any)','Home::reschedule/$1');
    $routes->get('admin/members','Home::Members');
    $routes->get('admin/report','Home::Report');
    $routes->get('admin/settings','Home::Settings');
    $routes->get('admin/edit/(:any)','Home::editUser/$1');
    $routes->get('admin/new','Home::newAccount');
    $routes->get('admin/profile','Home::Profile');
    $routes->get('admin/create-poll','Home::createPoll');
    $routes->get('admin/edit-survey/(:any)','Home::editSurvey/$1');
    $routes->get('admin/create-question','Home::createQuestion');
    $routes->get('admin/create-blog','Home::createBlog');
    $routes->get('admin/edit-blog/(:any)','Home::editBlog/$1');
    $routes->get('admin/new-physician','Home::newDoctor');
    $routes->get('admin/edit-info/(:any)','Home::editInfo/$1');
    $routes->get('admin/edit-answer/(:any)','Home::editAnswer/$1');
    $routes->get('admin/add-answer/(:any)','Home::addAnswer/$1');
    $routes->get('admin/maintenance','Home::Maintenance');
    $routes->get('admin/view-response','Home::viewResponse');
});

$routes->group('',['filter'=>'customerAuthCheck'],function($routes)
{
    $routes->get('customer/dashboard','Customer::Index');
    $routes->get('customer/take-a-test','Customer::takeATest');
    $routes->get('customer/consult-now','Customer::Consultation');
    $routes->get('customer/profile','Customer::Profile');
    $routes->get('customer/history','Customer::History');
});

$routes->group('',['filter'=>'AlreadyLoggedIn'],function($routes)
{
    $routes->get('/auth','Home::Auth');
});

$routes->group('',['filter'=>'customerAlreadyLoggedIn'],function($routes)
{
    $routes->get('/login','Home::login');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
