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
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index', ['filter' => 'authGuard']);
$routes->get('/', 'AllversionController::loaddata_data_type/1', ['filter' => 'authGuard']);
$routes->get('/login', 'LoginController::index', ['filter' => 'authGuard_login']);
$routes->get('/logout', 'LoginController::logout');
$routes->match(['get', 'post'], '/login/loginAuth', 'LoginController::loginAuth');

$routes->get('/profile', 'ProfileController::index', ['filter' => 'authGuard']);

$routes->get('/under_construction', 'Under_Construction::index', ['filter' => 'authGuard']);

$routes->group("context", ['filter' => 'authGuard'], function ($routes) {
    $routes->match(['get', 'post'], 'delete/(:num)', 'AllversionController::delete/$1');
    $routes->match(['get', 'post'], 'update_context', 'AllversionController::update_context');
    $routes->match(['get', 'post'], 'update_date/(:num)/(:num)', 'AllversionController::update_date/$1/$2');
    $routes->match(['get', 'post'], 'copydata/(:num)', 'AllversionController::copyData/$1');
    $routes->match(['get', 'post'], 'status_update/(:num)/(:num)', 'AllversionController::update_status/$1/$2');
    $routes->match(['get', 'post'], 'status_update_reject/(:num)', 'AllversionController::update_status_reject/$1');

    //--create version--//
    $routes->match(['get', 'post'], 'version/create/(:num)/(:num)', 'AllversionController::context_analysis_version_create/$1/$2');

    //--load check type--//
    $routes->match(['get', 'post'], 'loaddatatype/(:num)', 'AllversionController::loaddata_data_type/$1');

    //--get data from table context of type--//
    $routes->match(['get', 'post'], 'getAllcontexts/(:num)', 'AllversionController::getAllcontexts/$1');

    $routes->match(['get', 'post'], 'note_create/(:num)/(:num)', 'NoteController::save_note/$1/$2');
    $routes->match(['get', 'post'], 'note_edit/(:num)', 'NoteController::get_note/$1');
    $routes->match(['get', 'post'], 'note_update/(:num)/(:num)', 'NoteController::update_note/$1/$2');
    $routes->match(['get', 'post'], 'note_delete/(:num)', 'NoteController::delete_note/$1');
    $routes->match(['get', 'post'], 'comment_note/(:num)/(:num)/(:num)/(:num)', 'NoteController::comment_note/$1/$2/$3/$4');
    $routes->match(['get', 'post'], 'notecomment_delete/(:num)', 'NoteController::delete_notecomment/$1');
});

$routes->group("context/context_analysis", ['filter' => 'authGuard'], function ($routes) {

    //--display all version of type--//
    $routes->match(['get', 'post'], 'index/(:num)', 'AllversionController::context_index/$1');
    //--display type--//
    //-inter / exter-//
    $routes->match(['get', 'post'], '(:num)/(:num)', 'AllversionController::context_analysis_version/$1/$2');
    //--display timeline of id_version--//
    $routes->match(['get', 'post'], 'timeline_log/(:num)/(:num)/(:num)', 'TimelineController::index/$1/$2/$3');
    //--create note now status--//
    $routes->match(['get', 'post'], 'note_create/(:num)/(:num)', 'NoteController::save_note/$1/$2');

    $routes->match(['get', 'post'], 'context_All/edit/(:num)/(:num)', 'AllversionController::edit_all/$1/$2'); //--รอการลบออก--//

    //--Internal--//
    $routes->match(['get', 'post'], 'context_inter/find_data/(:num)', 'InterController::get_inter_table/$1'); //--find data table--//
    $routes->match(['get', 'post'], 'context_inter/store/(:num)/(:num)', 'InterController::store/$1/$2'); //--create data--//
    $routes->match(['get', 'post'], 'context_inter/edit/(:num)/(:num)', 'InterController::edit/$1/$2'); //--edit data--//
    $routes->match(['get', 'post'], 'context_inter/copydata/(:num)/(:num)/(:num)/(:num)', 'InterController::copyData/$1/$2/$3/$4'); //--copy data--//
    $routes->match(['get', 'post'], 'context_inter/delete/(:num)/(:num)/(:num)/(:num)/(:num)', 'InterController::delete/$1/$2/$3/$4/$5'); //--delete data--//
    $routes->match(['get', 'post'], 'context_inter/delete_file/(:num)/(:num)/(:num)/(:num)/(:num)', 'InterController::delete_file/$1/$2/$3/$4/$5'); //--delete file--//

    //--External--//
    $routes->match(['get', 'post'], 'context_exter/find_data/(:num)', 'ExterController::get_exter_table/$1'); //--find data table--//
    $routes->match(['get', 'post'], 'context_exter/store/(:num)/(:num)', 'ExterController::store/$1/$2'); //--create data--//
    $routes->match(['get', 'post'], 'context_exter/edit/(:num)/(:num)', 'ExterController::edit/$1/$2'); //--edit data--//
    $routes->match(['get', 'post'], 'context_exter/copydata/(:num)/(:num)/(:num)/(:num)', 'ExterController::copyData/$1/$2/$3/$4'); //--copy data--//
    $routes->match(['get', 'post'], 'context_exter/delete/(:num)/(:num)/(:num)/(:num)/(:num)', 'ExterController::delete/$1/$2/$3/$4/$5'); //--delete data--//
    $routes->match(['get', 'post'], 'context_exter/delete_file/(:num)/(:num)/(:num)/(:num)/(:num)', 'ExterController::delete_file/$1/$2/$3/$4/$5'); //--delete file--//
});

$routes->group("context/interested_party", ['filter' => 'authGuard'], function ($routes) {

    //--display all version of type--//
    $routes->match(['get', 'post'], 'index/(:num)', 'AllversionController::context_index/$1');

    //--create version--//
    $routes->match(['get', 'post'], 'version/create/(:num)/(:num)', 'AllversionController::context_analysis_version_create/$1/$2');

    //--display type--//
    //-interested-//
    $routes->match(['get', 'post'], '(:num)/(:num)', 'InterestedController::interested_index/$1/$2');

    //--display timeline of id_version--//
    $routes->match(['get', 'post'], 'timeline_log/(:num)/(:num)/(:num)', 'TimelineController::index/$1/$2/$3');

    //--create note now status--//
    $routes->match(['get', 'post'], 'note_create/(:num)/(:num)', 'NoteController::save_note/$1/$2');
    $routes->match(['get', 'post'], 'context_interested/find_data/(:num)', 'InterestedController::get_interested_table/$1'); //--find data--//
    $routes->match(['get', 'post'], 'context_interested/delete_file/(:num)/(:num)/(:num)/(:num)/(:num)', 'InterestedController::delete_file/$1/$2/$3/$4/$5'); //-file_delete-//
    $routes->match(['get', 'post'], 'context_interested/delete/(:num)/(:num)/(:num)/(:num)/(:num)', 'InterestedController::delete/$1/$2/$3/$4/$5'); //-delete-//
    $routes->match(['get', 'post'], 'context_interested/copydata/(:num)/(:num)/(:num)/(:num)', 'InterestedController::copyData/$1/$2/$3/$4'); //-copy-//
    $routes->match(['get', 'post'], 'context_interested/store/(:num)/(:num)', 'InterestedController::store/$1/$2'); //-create-//
    $routes->match(['get', 'post'], 'context_interested/edit/(:num)/(:num)', 'InterestedController::edit/$1/$2'); //-edit-//
});

$routes->group("context/isms_scope", ['filter' => 'authGuard'], function ($routes) {

    //--display all version of type--//
    $routes->match(['get', 'post'], 'index/(:num)', 'AllversionController::context_index/$1');

    //--create version--//
    $routes->match(['get', 'post'], 'version/create/(:num)/(:num)', 'AllversionController::context_analysis_version_create/$1/$2');

    //--display type--//
    //-interested-//
    $routes->match(['get', 'post'], '(:num)/(:num)', 'ISMS_ScopeController::isms_scope_index/$1/$2');

    //--display timeline of id_version--//
    $routes->match(['get', 'post'], 'timeline_log/(:num)/(:num)/(:num)', 'TimelineController::index/$1/$2/$3');

    //--create note now status--//
    $routes->match(['get', 'post'], 'note_create/(:num)/(:num)', 'NoteController::save_note/$1/$2');


    //--scopes--//
    $routes->match(['get', 'post'], 'context_isms_scope/store/(:num)/(:num)', 'ISMS_ScopeController::store/$1/$2'); //-create-//
    $routes->match(['get', 'post'], 'context_isms_scope/edit/(:num)/(:num)/(:num)', 'ISMS_ScopeController::edit/$1/$2/$3'); //-edit-//

    //--scopes AD--//
    $routes->match(['get', 'post'], 'context_isms_scope_ad/find_data/(:num)', 'ISMS_ScopeADController::get_scope_ad_table/$1'); //--find data--//
    $routes->match(['get', 'post'], 'context_isms_scope_ad/delete_file/(:num)/(:num)/(:num)/(:num)/(:num)', 'ISMS_ScopeADController::delete_file/$1/$2/$3/$4/$5'); //-file_delete-//
    $routes->match(['get', 'post'], 'context_isms_scope_ad/delete/(:num)/(:num)/(:num)/(:num)/(:num)', 'ISMS_ScopeADController::delete/$1/$2/$3/$4/$5'); //-delete-//
    $routes->match(['get', 'post'], 'context_isms_scope_ad/copydata/(:num)/(:num)/(:num)/(:num)', 'ISMS_ScopeADController::copyData/$1/$2/$3/$4'); //-copy-//
    $routes->match(['get', 'post'], 'context_isms_scope_ad/store/(:num)/(:num)', 'ISMS_ScopeADController::store/$1/$2'); //-create-//
    $routes->match(['get', 'post'], 'context_isms_scope_ad/edit', 'ISMS_ScopeADController::edit'); //-edit_file-//



});

$routes->group("context/isms_process", ['filter' => 'authGuard'], function ($routes) {


    //--display type--//
    //-isms_process-//
    $routes->match(['get', 'post'], '(:num)/(:num)', 'ISMS_ProcessController::isms_process_index/$1/$2');

    $routes->match(['get', 'post'], 'context_isms_process/find_data/(:num)', 'ISMS_ProcessController::get_isms_process_table/$1'); //--find data--//
    $routes->match(['get', 'post'], 'context_isms_process/delete_file/(:num)/(:num)/(:num)', 'ISMS_ProcessController::delete_file/$1/$2/$3'); //-delete-file//
    $routes->match(['get', 'post'], 'context_isms_process/delete/(:num)/(:num)/(:num)', 'ISMS_ProcessController::delete/$1/$2/$3'); //-delete-//
    $routes->match(['get', 'post'], 'context_isms_process/copydata/(:num)/(:num)', 'ISMS_ProcessController::copyData/$1/$2'); //-copy-//
    $routes->match(['get', 'post'], 'context_isms_process/store/(:num)', 'ISMS_ProcessController::store/$1'); //-create-//
    $routes->match(['get', 'post'], 'context_isms_process/edit', 'ISMS_ProcessController::edit'); //-edit-//
});

$routes->group("leadership/", ['filter' => 'authGuard'], function ($routes) {
    //Leadership & Commitment
    $routes->match(['get', 'post'], 'commitment/index/(:num)', 'Leadership_CommitmentController::index/$1');
    $routes->match(['get', 'post'], 'commitment/org/create_first_time/(:num)', 'Leadership_CommitmentController::create_organizational_firsttime/$1');
    $routes->match(['get', 'post'], 'commitment/org/edit/(:num)', 'Leadership_CommitmentController::edit_organizational/$1');

    $routes->match(['get', 'post'], 'commitment/is_objective/index/(:num)/(:num)', 'Leadership_CommitmentController::is_objective_index/$1/$2');
    $routes->match(['get', 'post'], 'commitment/is_objective/create/(:num)/(:num)', 'Leadership_CommitmentController::is_objective_create/$1/$2');
    $routes->match(['get', 'post'], 'commitment/is_objective/edit/(:num)/(:num)/(:num)', 'Leadership_CommitmentController::is_objective_edit/$1/$2/$3');
    $routes->match(['get', 'post'], 'commitment/is_objective/copy/(:num)', 'Leadership_CommitmentController::is_objective_copy/$1/');
    $routes->match(['get', 'post'], 'commitment/is_objective/delete/(:num)/(:num)/(:num)', 'Leadership_CommitmentController::is_objective_delete/$1/$2/$3');
    $routes->match(['get', 'post'], 'commitment/is_objective/getdata/(:num)', 'Leadership_CommitmentController::getdatatable_objective/$1');

    //Leadership - Policy
    $routes->match(['get', 'post'], 'policy/(:num)/(:num)', 'Leadership_PolicyController::is_policy_index/$1/$2'); //--display Policy--//
    $routes->match(['get', 'post'], 'policy/find_data/(:num)', 'Leadership_PolicyController::get_is_policy_table/$1'); //--find data--//
    $routes->match(['get', 'post'], 'policy/store/(:num)', 'Leadership_PolicyController::store/$1'); //-create-//
    $routes->match(['get', 'post'], 'policy/edit', 'Leadership_PolicyController::edit'); //-edit-//
    $routes->match(['get', 'post'], 'policy/delete/(:num)/(:num)/(:num)', 'Leadership_PolicyController::delete/$1/$2/$3'); //-delete-//
    $routes->match(['get', 'post'], 'policy/delete_file/(:num)/(:num)/(:num)', 'Leadership_PolicyController::delete_file/$1/$2/$3'); //-file_delete-//
    $routes->match(['get', 'post'], 'policy/copydata/(:num)/(:num)', 'Leadership_PolicyController::copyData/$1/$2');  //-copy-// 

    //Leadership - ISMS
    $routes->match(['get', 'post'], 'isms/index/(:num)', 'Leadership_ISMSController::index/$1');
    $routes->match(['get', 'post'], 'isms/create/(:num)', 'Leadership_ISMSController::responsibilities_create/$1');
    $routes->match(['get', 'post'], 'isms/edit/(:num)', 'Leadership_ISMSController::responsibilities_edit/$1');
    $routes->match(['get', 'post'], 'isms/delete/(:num)/(:num)', 'Leadership_ISMSController::responsibilities_delete/$1/$2');
    $routes->match(['get', 'post'], 'isms/delete_file/(:num)/(:num)', 'Leadership_ISMSController::responsibilities_delete_file/$1/$2');
    $routes->match(['get', 'post'], 'isms/copy/(:num)', 'Leadership_ISMSController::responsibilities_copy/$1');
    $routes->match(['get', 'post'], 'isms/getdata/(:num)', 'Leadership_ISMSController::getdatatable_Responsibilities/$1');

    //Leadership - Files
    $routes->match(['get', 'post'], 'file_ls/getdata/(:num)', 'Leadership_FilesController::getdatatable_file/$1');
    $routes->match(['get', 'post'], 'file_ls/create/(:num)', 'Leadership_FilesController::file_ls_create/$1');
    $routes->match(['get', 'post'], 'file_ls/open/(:num)', 'Leadership_FilesController::file_ls_open/$1');
    $routes->match(['get', 'post'], 'file_ls/delete/(:num)', 'Leadership_FilesController::file_ls_delete/$1');
    $routes->match(['get', 'post'], 'file_ls/rename/(:num)', 'Leadership_FilesController::file_ls_renamefile/$1');
    $routes->match(['get', 'post'], 'file_ls/dowloadfile/(:num)', 'Leadership_FilesController::file_ls_dowloadfile/$1');
});

$routes->group("database", ['filter' => 'authGuard'], function ($routes) {
    $routes->get('userlist/index', 'User_Controller::index');
    $routes->match(['get', 'post'], 'userlist/create', 'User_Controller::create_User');
    $routes->match(['get', 'post'], 'userlist/edit/(:num)', 'User_Controller::edit_User/$1');
    $routes->match(['get', 'post'], 'ownuserlist/edit/(:num)', 'User_Controller::edit_OwnUser/$1');

    $routes->get('context_select/index', 'Context_SelectController::index');
    $routes->match(['get', 'post'], 'context_select/update', 'Context_SelectController::update');
    $routes->match(['get', 'post'], 'context_select/getdata', 'Context_SelectController::getData');
    $routes->match(['get', 'post'], 'context_select/create', 'Context_SelectController::Create');

    $routes->get('context_requirement/index', 'RequirementController::index');
    $routes->match(['get', 'post'], 'context_requirement/update', 'RequirementController::update');
    $routes->match(['get', 'post'], 'context_requirement/create', 'RequirementController::Create');

    $routes->get('role/index', 'Role_Controller::index');
    $routes->match(['get', 'post'], 'rolelist/edit/(:num)', 'Role_Controller::edit_Role/$1');
    $routes->match(['get', 'post'], 'rolelist/create', 'Role_Controller::create_Role');

    $routes->get('log_list/index', 'ActivitesLogController::index');
    $routes->match(['get', 'post'], 'log_list/getDatalog/(:num)/(:num)/(:num)', 'ActivitesLogController::getDatalog/$1/$2/$3');

});

$routes->group("permission", ['filter' => 'authGuard'], function ($routes) {
    $routes->get('context/index', 'PermissionController::index');
    $routes->match(['get', 'post'], 'context/create', 'PermissionController::CreateData');
    $routes->match(['get', 'post'], 'userlist/edit/(:num)', 'PermissionController::edit_User/$1');

});

$routes->group("planning", ['filter' => 'authGuard'], function ($routes) {
    //-- Planning IS Objectives --//
    $routes->match(['get', 'post'], 'isobjective/index/(:num)/(:num)', 'ISObjectivesController::index/$1/$2'); //index
    $routes->match(['get', 'post'], 'isobjective/getdata/(:num)', 'ISObjectivesController::get_data_objective/$1'); //index
    $routes->match(['get', 'post'], 'isobjective/create/(:num)/(:num)', 'ISObjectivesController::create_objective/$1/$2'); //create
    $routes->match(['get', 'post'], 'isobjective/edit/(:num)/(:num)/(:num)', 'ISObjectivesController::edit_objective/$1/$2/$3'); //edit
    $routes->match(['get', 'post'], 'isobjective/copydata/(:num)/(:num)/(:num)/(:num)', 'ISObjectivesController::copy_objective/$1/$2/$3/$4'); //copy
    $routes->match(['get', 'post'], 'isobjective/delete/(:num)/(:num)/(:num)/(:num)', 'ISObjectivesController::delete_objective/$1/$2/$3/$4'); //delete

    $routes->match(['get', 'post'], 'planning/getdata/(:num)', 'ISObjectivesController::get_data_planning/$1'); //index
    $routes->match(['get', 'post'], 'planning/create/(:num)/(:num)', 'ISObjectivesController::create_planning/$1/$2'); //create
    $routes->match(['get', 'post'], 'planning/edit/(:num)/(:num)/(:num)', 'ISObjectivesController::edit_planning/$1/$2/$3'); //edit
    $routes->match(['get', 'post'], 'planning/copydata/(:num)/(:num)/(:num)/(:num)', 'ISObjectivesController::copy_planning/$1/$2/$3/$4'); //copy
    $routes->match(['get', 'post'], 'planning/delete/(:num)/(:num)/(:num)/(:num)/(:num)', 'ISObjectivesController::delete_planning/$1/$2/$3/$4/$5'); //delete

    $routes->match(['get', 'post'], 'isobjective/timeline_log/(:num)/(:num)/(:num)', 'TimelineController::index/$1/$2/$3'); //timeline

    //-- Planning of Change --//
    $routes->match(['get', 'post'], 'index/(:num)', 'AllversionController::context_index/$1');
    $routes->match(['get', 'post'], 'planningofchange/(:num)', 'PlanningofChangeController::index/$1');
});


$routes->match(['get', 'post'], 'openfile/(:num)', 'AllversionController::openfile/$1', ['filter' => 'authGuard']);
$routes->match(['get', 'post'], 'renamefile/(:num)', 'AllversionController::renamefile/$1', ['filter' => 'authGuard']);
$routes->match(['get', 'post'], 'dowloadfile/(:num)', 'AllversionController::dowloadfile/$1', ['filter' => 'authGuard']);


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