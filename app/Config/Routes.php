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
$routes->get('/crud_risk', 'Home::CRUD_RiskOppContext');

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

    //-- Address Risks & Opportunities --//
    //context
    $routes->get('planningAddressRisksOpp/context/index/(:num)/(:num)', 'Planning_AddressRisksOppController::index_context/$1/$2'); //index

    $routes->get('crud_context_risk_opp/(:num)/(:num)', 'Planning_AddressRisksOppController::indexCrudContext/$1/$2'); //index create context
    $routes->get('crud_context_risk_opp/edit/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::indexEditContext_risk/$1/$2/$3'); //index edit context
    $routes->get('crud_context_risk_opp/view/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::indexViewContext_risk/$1/$2/$3'); //index view context risk
    $routes->get('crud_context_risk_opp/opportunities/view/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::indexViewContext_opportunity/$1/$2/$3'); //index view context opportunities
    $routes->get('crud_context_risk_opp/opportunities/edit/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::indexEditContext_opportunity/$1/$2/$3'); //index edit opp

    $routes->match(['get', 'post'], 'planningAddressRisksOpp/context/risk/create/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::createContext_risk/$1/$2/$3'); //create risk context
    $routes->match(['get', 'post'], 'planningAddressRisksOpp/context/risk/edit/(:num)/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::editContext_risk/$1/$2/$3/$4'); //create risk context
    $routes->match(['get', 'post'], 'planningAddressRisksOpp/context/risk/delete/(:num)/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::deleteContext_risk/$1/$2/$3/$4'); //delete risk context
    $routes->match(['get', 'post'], 'planningAddressRisksOpp/context/risk/getdata/(:num)', 'Planning_AddressRisksOppController::getContext_data_risk/$1'); //getdata risk context

    $routes->match(['get', 'post'], 'planningAddressRisksOpp/context/opportunities/create/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::createContext_opportunity/$1/$2/$3'); //create opportunities context
    $routes->match(['get', 'post'], 'planningAddressRisksOpp/context/opportunities/edit/(:num)/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::editContext_opportunity/$1/$2/$3/$4'); //edit opportunities context
    $routes->match(['get', 'post'], 'planningAddressRisksOpp/context/opportunities/getdata/(:num)', 'Planning_AddressRisksOppController::getContext_data_opportunity/$1'); //getdata risk context
    $routes->match(['get', 'post'], 'planningAddressRisksOpp/context/opportunities/delete/(:num)/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::deleteContext_opportunity/$1/$2/$3/$4'); //delete risk context


    $routes->match(['get', 'post'], 'planningAddressRisksOpp/context/timeline_log/(:num)/(:num)/(:num)', 'TimelineController::index/$1/$2/$3'); //timeline

    
    $routes->get('risk_Criteria_Context_Consequence', 'Setting_RiskCriteriaContextController::indexConsequence'); //index Consequence Level
    $routes->match(['get', 'post'], 'risk_Criteria_Context_Consequence/create', 'Setting_RiskCriteriaContextController::create_consequence'); //create Consequence Level
    $routes->match(['get', 'post'], 'risk_Criteria_Context_Consequence/edit/(:num)', 'Setting_RiskCriteriaContextController::edit_consequence/$1'); //delete Consequence Level
    $routes->match(['get', 'post'], 'risk_Criteria_Context_Consequence/delete/(:num)', 'Setting_RiskCriteriaContextController::delete_consequence/$1'); //delete Consequence Level
    $routes->match(['get', 'post'], 'risk_Criteria_Context_Consequence/change_impact_level/(:num)', 'Setting_RiskCriteriaContextController::change_impact_level/$1'); //change impact Level

    $routes->get('risk_Criteria_Context_Likelihood', 'Setting_RiskCriteriaContextController::indexLikelihood');//index Likelihood context
    $routes->match(['get', 'post'], 'risk_Criteria_Context_Likelihood/edit/(:num)', 'Setting_RiskCriteriaContextController::edit_likelihood/$1');//edit Likelihood context

    $routes->get('risk_Criteria_Context_Risk_Level', 'Setting_RiskCriteriaContextController::indexRiskLevel');//index Risk level
    $routes->match(['get', 'post'], 'risk_Criteria_Context_Risk_Level/create', 'Setting_RiskCriteriaContextController::create_RiskLevel');//create Risk level
    $routes->match(['get', 'post'], 'risk_Criteria_Context_Risk_Level/edit/(:num)', 'Setting_RiskCriteriaContextController::edit_RiskLevel/$1');//edit Risk level
    $routes->match(['get', 'post'], 'risk_Criteria_Context_Risk_Level/delete/(:num)', 'Setting_RiskCriteriaContextController::delete_RiskLevel/$1');//delete Risk level
    $routes->match(['get', 'post'], 'risk_Criteria_Context_Risk_Level/change_assessment_level/(:num)', 'Setting_RiskCriteriaContextController::change_assessment_level/$1');//change assessment level

    $routes->get('risk_Criteria_Context_Risk_Option', 'Setting_RiskCriteriaContextController::indexRiskOption');//index risk option
    $routes->match(['get', 'post'], 'risk_Criteria_Context_Risk_Option/create', 'Setting_RiskCriteriaContextController::create_RiskOption');//create Risk level
    $routes->match(['get', 'post'], 'risk_Criteria_Context_Risk_Option/edit/(:num)', 'Setting_RiskCriteriaContextController::edit_RiskOption/$1');//edit Risk level
    $routes->match(['get', 'post'], 'risk_Criteria_Context_Risk_Option/delete/(:num)', 'Setting_RiskCriteriaContextController::delete_RiskOption/$1');//edit Risk level

    //is
    $routes->get('planningAddressRisksOpp/is/index/(:num)/(:num)', 'Planning_AddressRisksOppController::index_is/$1/$2'); //index

    $routes->get('crud_is_risk_opp/(:num)/(:num)', 'Planning_AddressRisksOppController::indexCrudIS/$1/$2'); //index create is
    $routes->get('crud_is_risk_opp/edit/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::indexEditIS_risk/$1/$2/$3'); //index edit is
    $routes->get('crud_is_risk_opp/view/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::indexViewIS_risk/$1/$2/$3'); //index view is risk
    $routes->get('crud_is_risk_opp/opportunities/view/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::indexViewIS_opportunity/$1/$2/$3'); //index view is opportunities
    $routes->get('crud_is_risk_opp/opportunities/edit/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::indexEditIS_opportunity/$1/$2/$3'); //index edit opp

    $routes->match(['get', 'post'], 'planningAddressRisksOpp/is/risk/create/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::createIS_risk/$1/$2/$3'); //create risk is
    $routes->match(['get', 'post'], 'planningAddressRisksOpp/is/risk/edit/(:num)/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::editIS_risk/$1/$2/$3/$4'); //create risk is
    $routes->match(['get', 'post'], 'planningAddressRisksOpp/is/risk/delete/(:num)/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::deleteIS_risk/$1/$2/$3/$4'); //delete risk is
    $routes->match(['get', 'post'], 'planningAddressRisksOpp/is/risk/getdata/(:num)', 'Planning_AddressRisksOppController::getIS_data_risk/$1'); //getdata risk is

    $routes->match(['get', 'post'], 'planningAddressRisksOpp/is/opportunities/create/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::createIS_opportunity/$1/$2/$3'); //create opportunities is
    $routes->match(['get', 'post'], 'planningAddressRisksOpp/is/opportunities/edit/(:num)/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::editIS_opportunity/$1/$2/$3/$4'); //edit opportunities is
    $routes->match(['get', 'post'], 'planningAddressRisksOpp/is/opportunities/getdata/(:num)', 'Planning_AddressRisksOppController::getIS_data_opportunity/$1'); //getdata risk is
    $routes->match(['get', 'post'], 'planningAddressRisksOpp/is/opportunities/delete/(:num)/(:num)/(:num)/(:num)', 'Planning_AddressRisksOppController::deleteIS_opportunity/$1/$2/$3/$4'); //delete risk is


    $routes->match(['get', 'post'], 'planningAddressRisksOpp/is/timeline_log/(:num)/(:num)/(:num)', 'TimelineController::index/$1/$2/$3'); //timeline

    $routes->get('risk_Criteria_IS_Consequence', 'Setting_RiskCriteriaISController::indexConsequence'); //index Consequence Level
    $routes->match(['get', 'post'], 'risk_Criteria_IS_Consequence/create', 'Setting_RiskCriteriaISController::create_consequence'); //create Consequence Level
    $routes->match(['get', 'post'], 'risk_Criteria_IS_Consequence/edit/(:num)', 'Setting_RiskCriteriaISController::edit_consequence/$1'); //delete Consequence Level
    $routes->match(['get', 'post'], 'risk_Criteria_IS_Consequence/delete/(:num)', 'Setting_RiskCriteriaISController::delete_consequence/$1'); //delete Consequence Level
    $routes->match(['get', 'post'], 'risk_Criteria_IS_Consequence/change_impact_level/(:num)', 'Setting_RiskCriteriaISController::change_impact_level/$1'); //change impact Level

    $routes->get('risk_Criteria_IS_Likelihood', 'Setting_RiskCriteriaISController::indexLikelihood');//index Likelihood is
    $routes->match(['get', 'post'], 'risk_Criteria_IS_Likelihood/edit/(:num)', 'Setting_RiskCriteriaISController::edit_likelihood/$1');//edit Likelihood is

    $routes->get('risk_Criteria_IS_Risk_Level', 'Setting_RiskCriteriaISController::indexRiskLevel');//index Risk level
    $routes->match(['get', 'post'], 'risk_Criteria_IS_Risk_Level/create', 'Setting_RiskCriteriaISController::create_RiskLevel');//create Risk level
    $routes->match(['get', 'post'], 'risk_Criteria_IS_Risk_Level/edit/(:num)', 'Setting_RiskCriteriaISController::edit_RiskLevel/$1');//edit Risk level
    $routes->match(['get', 'post'], 'risk_Criteria_IS_Risk_Level/delete/(:num)', 'Setting_RiskCriteriaISController::delete_RiskLevel/$1');//delete Risk level
    $routes->match(['get', 'post'], 'risk_Criteria_IS_Risk_Level/change_assessment_level/(:num)', 'Setting_RiskCriteriaISController::change_assessment_level/$1');//change assessment level

    $routes->get('risk_Criteria_IS_Risk_Option', 'Setting_RiskCriteriaISController::indexRiskOption');//index risk option
    $routes->match(['get', 'post'], 'risk_Criteria_IS_Risk_Option/create', 'Setting_RiskCriteriaISController::create_RiskOption');//create Risk level
    $routes->match(['get', 'post'], 'risk_Criteria_IS_Risk_Option/edit/(:num)', 'Setting_RiskCriteriaISController::edit_RiskOption/$1');//edit Risk level
    $routes->match(['get', 'post'], 'risk_Criteria_IS_Risk_Option/delete/(:num)', 'Setting_RiskCriteriaISController::delete_RiskOption/$1');//edit Risk level

    //-- Planning IS Objectives --//
    $routes->match(['get', 'post'], 'isobjective/index/(:num)/(:num)', 'Planning_ISObjectivesController::index/$1/$2'); //index
    $routes->match(['get', 'post'], 'isobjective/getdata/(:num)', 'Planning_ISObjectivesController::get_data_objective/$1'); //index
    $routes->match(['get', 'post'], 'isobjective/create/(:num)/(:num)', 'Planning_ISObjectivesController::create_objective/$1/$2'); //create
    $routes->match(['get', 'post'], 'isobjective/edit/(:num)/(:num)/(:num)', 'Planning_ISObjectivesController::edit_objective/$1/$2/$3'); //edit
    $routes->match(['get', 'post'], 'isobjective/copydata/(:num)/(:num)/(:num)/(:num)', 'Planning_ISObjectivesController::copy_objective/$1/$2/$3/$4'); //copy
    $routes->match(['get', 'post'], 'isobjective/delete/(:num)/(:num)/(:num)/(:num)', 'Planning_ISObjectivesController::delete_objective/$1/$2/$3/$4'); //delete

    $routes->match(['get', 'post'], 'planning/getdata/(:num)', 'Planning_ISObjectivesController::get_data_planning/$1'); //getdata
    $routes->match(['get', 'post'], 'planning/create/(:num)/(:num)', 'Planning_ISObjectivesController::create_planning/$1/$2'); //create
    $routes->match(['get', 'post'], 'planning/edit/(:num)/(:num)/(:num)', 'Planning_ISObjectivesController::edit_planning/$1/$2/$3'); //edit
    $routes->match(['get', 'post'], 'planning/copydata/(:num)/(:num)/(:num)/(:num)', 'Planning_ISObjectivesController::copy_planning/$1/$2/$3/$4'); //copy
    $routes->match(['get', 'post'], 'planning/delete/(:num)/(:num)/(:num)/(:num)/(:num)', 'Planning_ISObjectivesController::delete_planning/$1/$2/$3/$4/$5'); //delete
    $routes->match(['get', 'post'], 'summary/getdata/(:num)', 'Planning_ISObjectivesController::get_data_summary/$1'); //getdata
    $routes->match(['get', 'post'], 'isobjective/timeline_log/(:num)/(:num)/(:num)', 'TimelineController::index/$1/$2/$3'); //timeline

    //-- Planning of Change --//
    $routes->match(['get', 'post'], 'planningofchange/(:num)/(:num)', 'Planning_PlanningofChangeController::planningofchange_index/$1/$2');
    $routes->match(['get', 'post'], 'planningofchange/find_data/(:num)', 'Planning_PlanningofChangeController::get_planning_of_changes_table/$1'); //--find data--//
    $routes->match(['get', 'post'], 'planningofchange/store/(:num)', 'Planning_PlanningofChangeController::store/$1'); //-create-//
    $routes->match(['get', 'post'], 'planningofchange/edit/(:num)', 'Planning_PlanningofChangeController::edit/$1'); //-edit-//
    $routes->match(['get', 'post'], 'planningofchange/delete/(:num)/(:num)/(:num)', 'Planning_PlanningofChangeController::delete/$1/$2/$3'); //-delete-//
    $routes->match(['get', 'post'], 'planningofchange/delete_file/(:num)/(:num)/(:num)', 'Planning_PlanningofChangeController::delete_file/$1/$2/$3'); //-file_delete-//
    $routes->match(['get', 'post'], 'planningofchange/copydata/(:num)/(:num)', 'Planning_PlanningofChangeController::copyData/$1/$2');  //-copy-// 

    //-- SOA --//
    // $routes->get('soa', 'SOAController::index');
    $routes->match(['get', 'post'], 'soa/index/(:num)/(:num)', 'SOAController::index/$1/$2'); //index
    $routes->match(['get', 'post'], 'soa/create/(:num)/(:num)', 'SOAController::create_SOA/$1/$2'); //create SOA
    $routes->match(['get', 'post'], 'soa/edit/(:num)/(:num)/(:num)', 'SOAController::edit_SOA/$1/$2/$3'); //edit SOA
    $routes->match(['get', 'post'], 'soa/delete/(:num)/(:num)/(:num)', 'SOAController::delete_SOA/$1/$2/$3'); //delete SOA
    $routes->match(['get', 'post'], 'soa/copydata/(:num)/(:num)/(:num)', 'SOAController::copy_SOA/$1/$2/$3'); //copy SOA

    $routes->match(['get', 'post'], 'soa/getdata/(:num)', 'SOAController::get_data_soa/$1'); //getdata

    $routes->match(['get', 'post'], 'soa/timeline_log/(:num)/(:num)/(:num)', 'TimelineController::index/$1/$2/$3'); //timeline

});

$routes->group("support", ['filter' => 'authGuard'], function ($routes) {
    //-- Support Competence --//
    $routes->match(['get', 'post'], 'competence/index/(:num)/(:num)', 'Support_CompetenceController::index/$1/$2'); //index
    $routes->match(['get', 'post'], 'competence/create/(:num)/(:num)', 'Support_CompetenceController::create_competence/$1/$2'); //index
    $routes->match(['get', 'post'], 'competence/edit/(:num)/(:num)/(:num)', 'Support_CompetenceController::edit_competence/$1/$2/$3'); //edit
    $routes->match(['get', 'post'], 'competence/copydata/(:num)/(:num)/(:num)/(:num)', 'Support_CompetenceController::copy_competence/$1/$2/$3/$4'); //copy
    $routes->match(['get', 'post'], 'competence/delete/(:num)/(:num)/(:num)/(:num)/(:num)', 'Support_CompetenceController::delete_competence/$1/$2/$3/$4/$5'); //delete
    $routes->match(['get', 'post'], 'competence/getdata/(:num)', 'Support_CompetenceController::get_data_competence/$1'); //getdata

    $routes->match(['get', 'post'], 'competence/timeline_log/(:num)/(:num)/(:num)', 'TimelineController::index/$1/$2/$3'); //timeline

    //-- Support Awareness --//
    $routes->match(['get', 'post'], 'awareness/index/(:num)/(:num)', 'Support_AwarenessController::index/$1/$2'); //index
    $routes->match(['get', 'post'], 'awareness/create/(:num)/(:num)', 'Support_AwarenessController::create_awareness/$1/$2'); //create
    $routes->match(['get', 'post'], 'awareness/edit/(:num)/(:num)/(:num)', 'Support_AwarenessController::edit_awareness/$1/$2/$3'); //edit
    $routes->match(['get', 'post'], 'awareness/delete/(:num)/(:num)/(:num)/(:num)', 'Support_AwarenessController::delete_awareness/$1/$2/$3/$4'); //delete
    $routes->match(['get', 'post'], 'awareness/copydata/(:num)/(:num)/(:num)/(:num)', 'Support_AwarenessController::copy_awareness/$1/$2/$3/$4'); //copy

    $routes->match(['get', 'post'], 'awareness/getdata/(:num)', 'Support_AwarenessController::get_data_awareness/$1'); //getdata

    $routes->match(['get', 'post'], 'awareness/timeline_log/(:num)/(:num)/(:num)', 'TimelineController::index/$1/$2/$3'); //timeline

    //-- Support Communication --//
    $routes->match(['get', 'post'], 'communication/index/(:num)/(:num)', 'Support_CommunicationController::index/$1/$2'); //index
    $routes->match(['get', 'post'], 'communication/create/(:num)/(:num)', 'Support_CommunicationController::create_communication/$1/$2'); //create
    $routes->match(['get', 'post'], 'communication/edit/(:num)/(:num)/(:num)', 'Support_CommunicationController::edit_communication/$1/$2/$3'); //edit
    $routes->match(['get', 'post'], 'communication/delete/(:num)/(:num)/(:num)/(:num)', 'Support_CommunicationController::delete_communication/$1/$2/$3/$4'); //delete
    $routes->match(['get', 'post'], 'communication/copydata/(:num)/(:num)/(:num)/(:num)', 'Support_CommunicationController::copy_communication/$1/$2/$3/$4'); //copy

    $routes->match(['get', 'post'], 'communication/getdata/(:num)', 'Support_CommunicationController::get_data_communication/$1'); //getdata

    $routes->match(['get', 'post'], 'communication/timeline_log/(:num)/(:num)/(:num)', 'TimelineController::index/$1/$2/$3'); //timeline

    //-- Support Documentation --//
    $routes->match(['get', 'post'], 'documentation/index/(:num)/(:num)', 'DocumentedController::index/$1/$2'); //index
    $routes->match(['get', 'post'], 'documentation/create/index/(:num)/(:num)/(:num)', 'DocumentedController::indexCrudCreateUpdate/$1/$2/$3'); //index create documentation
    $routes->match(['get', 'post'], 'documentation/create/insert/(:num)/(:num)/(:num)', 'DocumentedController::create_documented/$1/$2/$3'); //create documentation
    $routes->match(['get', 'post'], 'documentation/create/getdata/(:num)', 'DocumentedController::get_data_documented_create/$1'); //getdata create documentation

    $routes->match(['get', 'post'], 'documentation/management/getdata/(:num)', 'DocumentedController::get_data_documented_management/$1'); //getdata management documentation
    $routes->match(['get', 'post'], 'documentation/management/index/(:num)/(:num)/(:num)/(:num)', 'DocumentedController::indexCrudManagementDoc/$1/$2/$3/$4'); //index management documentation
    $routes->match(['get', 'post'], 'documentation/management/index/view/(:num)/(:num)/(:num)/(:num)', 'DocumentedController::indexCrudManagementDoc_View/$1/$2/$3/$4'); //index management documentation
    $routes->match(['get', 'post'], 'documentation/management/edit/(:num)/(:num)/(:num)', 'DocumentedController::edit_documented/$1/$2/$3'); //edit management documentation
    $routes->match(['get', 'post'], 'documentation/management/update/status/(:num)/(:num)/(:num)/(:num)', 'DocumentedController::update_status_documented/$1/$2/$3/$4'); //update status management documentation

    $routes->match(['get', 'post'], 'documentation/documentControl/index/(:num)/(:num)/(:num)/(:num)', 'DocumentedController::indexCrudControl/$1/$2/$3/$4'); //index management documentation
    $routes->match(['get', 'post'], 'documentation/documentControl/index/view/(:num)/(:num)/(:num)/(:num)', 'DocumentedController::indexViewControl/$1/$2/$3/$4'); //index management documentation
    $routes->match(['get', 'post'], 'documentation/documentControl/getdata/(:num)', 'DocumentedController::get_data_documented_approved/$1'); //getdata approved documentation
    $routes->match(['get', 'post'], 'documentation/documentControl/edit/(:num)/(:num)/(:num)', 'DocumentedController::edit_documented_approved/$1/$2/$3'); //getdata approved documentation

    $routes->match(['get', 'post'], 'documentation/delete/(:num)/(:num)/(:num)', 'DocumentedController::delete_documented/$1/$2/$3'); //delete documentation

    $routes->match(['get', 'post'], 'documentation/timeline_log/(:num)/(:num)/(:num)', 'TimelineController::index/$1/$2/$3'); //timeline
});

$routes->group("operations", ['filter' => 'authGuard'], function ($routes) {
    $routes->match(['get', 'post'], 'operations_management/index', 'OP_OperationsManagementController::index_operations_management');

    $routes->match(['get', 'post'], 'operations_management/risk_context/getdata', 'OP_OperationsManagementController::get_data_risk_context');
    $routes->match(['get', 'post'], 'operations_management/risk_context/edit/(:num)', 'OP_OperationsManagementController::operation_edit_risk_context/$1');

    $routes->match(['get', 'post'], 'operations_management/risk_is/getdata', 'OP_OperationsManagementController::get_data_risk_is');
    $routes->match(['get', 'post'], 'operations_management/risk_is/edit/(:num)', 'OP_OperationsManagementController::operation_edit_risk_is/$1');

    $routes->match(['get', 'post'], 'operations_management/is_objectives/getdata', 'OP_OperationsManagementController::get_data_is_objectives');
    $routes->match(['get', 'post'], 'operations_management/is_objectives/edit/(:num)/(:num)', 'OP_OperationsManagementController::operation_edit_is_objectives/$1/$2');

    $routes->match(['get', 'post'], 'operations_management/planning_change/getdata', 'OP_OperationsManagementController::get_data_planning_change');
    $routes->match(['get', 'post'], 'operations_management/planning_change/edit/(:num)', 'OP_OperationsManagementController::operation_edit_planning_change/$1');
});

$routes->group("performance", ['filter' => 'authGuard'], function ($routes) {
    $routes->match(['get', 'post'], 'performance_management/index', 'Perf_PerformanceEvaluationController::index_performance_management');
    $routes->match(['get', 'post'], 'performance_management/getdata/(:num)', 'Perf_PerformanceEvaluationController::get_data_planning_is_objective/$1');
    $routes->match(['get', 'post'], 'performance_management/edit/(:num)', 'Perf_PerformanceEvaluationController::edit_performance_management/$1');

    $routes->match(['get', 'post'], 'management_review/index', 'Perf_ManagementReviewController::index_management_review');
    $routes->match(['get', 'post'], 'management_review/getdata', 'Perf_ManagementReviewController::get_data_management_review');
    $routes->match(['get', 'post'], 'management_review/create', 'Perf_ManagementReviewController::create_management_review');
    $routes->match(['get', 'post'], 'management_review/edit/(:num)', 'Perf_ManagementReviewController::edit_management_review/$1');
    $routes->match(['get', 'post'], 'management_review/copydata/(:num)', 'Perf_ManagementReviewController::copy_management_review/$1');
    $routes->match(['get', 'post'], 'management_review/delete/(:num)', 'Perf_ManagementReviewController::delete_management_review/$1');

    
});

$routes->group("improvements", ['filter' => 'authGuard'], function ($routes) {
    $routes->match(['get', 'post'], 'improvements_overview/index', 'Impr_ImprovementsOverviewController::index');
    $routes->match(['get', 'post'], 'improvements_overview/getdata', 'Impr_ImprovementsOverviewController::get_data_improvements_overview');

    $routes->match(['get', 'post'], 'improvements_overview/create', 'Impr_ImprovementsOverviewController::create_improvements_overview');
    $routes->match(['get', 'post'], 'improvements_overview/update/(:num)', 'Impr_ImprovementsOverviewController::update_improvements_overview/$1');
    $routes->match(['get', 'post'], 'improvements_overview/copydata/(:num)', 'Impr_ImprovementsOverviewController::copy_improvements_overview/$1');
    $routes->match(['get', 'post'], 'improvements_overview/delete/(:num)', 'Impr_ImprovementsOverviewController::delete_improvements_overview/$1');

    $routes->match(['get', 'post'], 'nonconformity_action/index', 'Impr_NonconformityActionController::index');
    $routes->match(['get', 'post'], 'nonconformity_action/nonconformity/getdata', 'Impr_NonconformityActionController::get_data_nonconformity_action_nonconformity'); //index
    $routes->match(['get', 'post'], 'nonconformity_action/observation/getdata', 'Impr_NonconformityActionController::get_data_nonconformity_action_observation'); //index
    $routes->match(['get', 'post'], 'nonconformity_action/opportunity/getdata', 'Impr_NonconformityActionController::get_data_nonconformity_action_opportunity'); //index
});

$routes->group("internal_audit", ['filter' => 'authGuard'], function ($routes) {
    $routes->get('index', 'Perf_InternalAuditController::index');

    $routes->match(['get', 'post'], 'audit_program/create', 'Perf_InternalAuditController::create_audit_plan');

    $routes->match(['get', 'post'], 'initial_data/update/(:num)', 'Perf_InternalAuditController::update_initial_data/$1');

    $routes->match(['get', 'post'], 'schedule/create', 'Perf_InternalAuditController::create_schedule');

    $routes->match(['get', 'post'], 'checklist/create', 'Perf_InternalAuditController::create_checklist');
    $routes->match(['get', 'post'], 'checklist/update/(:num)', 'Perf_InternalAuditController::update_checklist/$1');
    $routes->match(['get', 'post'], 'checklist/copydata/(:num)', 'Perf_InternalAuditController::copy_checklist/$1');
    $routes->match(['get', 'post'], 'checklist/delete/(:num)', 'Perf_InternalAuditController::delete_checklist/$1');

    $routes->match(['get', 'post'], 'report/create', 'Perf_InternalAuditController::create_report');
    $routes->match(['get', 'post'], 'report/update/(:num)', 'Perf_InternalAuditController::update_report/$1');
    $routes->match(['get', 'post'], 'report/copydata/(:num)', 'Perf_InternalAuditController::copy_report/$1');
    $routes->match(['get', 'post'], 'report/delete/(:num)', 'Perf_InternalAuditController::delete_report/$1');

    $routes->match(['get', 'post'], 'audit_management/schedule_plan/getdata/(:num)', 'Perf_InternalAuditController::get_data_audit_management_schedule_plan/$1'); //index
    $routes->match(['get', 'post'], 'audit_management/audit_checklist/getdata/(:num)', 'Perf_InternalAuditController::get_data_audit_management_audit_checklist/$1'); //index
    $routes->match(['get', 'post'], 'audit_management/audit_report/getdata/(:num)', 'Perf_InternalAuditController::get_data_audit_management_audit_report/$1'); //index

    $routes->match(['get', 'post'], 'audit_management/audit_program/getdata', 'Perf_InternalAuditController::get_data_audit_management_audit_program'); //index

    $routes->match(['get', 'post'], 'audit_management/audit_plan/getdata', 'Perf_InternalAuditController::get_data_audit_management_audit_plan'); //index

    $routes->match(['get', 'post'], 'audit_result/nonconformity/getdata', 'Perf_InternalAuditController::get_data_audit_result_nonconformity'); //index
    $routes->match(['get', 'post'], 'audit_result/observation/getdata', 'Perf_InternalAuditController::get_data_audit_result_observation'); //index
    $routes->match(['get', 'post'], 'audit_result/opportunity/getdata', 'Perf_InternalAuditController::get_data_audit_result_opportunity'); //index
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