<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */
// Route::get('/', [
//         'as' => 'index',
//         'uses' => 'HomeController@showWelcome'
// ]);
/**
 * Login
 */

Route::get('/', [
    'as' => 'login-index',
    'uses' => 'LoginController@index'
]);
Route::get('logout', [
    'as' => 'logout',
    'uses' => 'LoginController@getLogout'
]);
Route::get('/home', [
    'before'=>'auth',
    'as' => 'home',
    'uses' => 'HomeController@gethome'
]);
Route::get('/home/report', [
    'before'=>'auth',
    'as' => 'report',
    'uses' => 'HomeController@getReport'
]);
Route::group(['before' => 'csrf'], function () {
    Route::post('/login', [
        'as' => 'login-post',
        'uses' => 'LoginController@postLogin'
    ]);
});

/**
 * Engineer Skill  Module
 */
Route::group(['before'=>'auth', 'prefix' => 'engineer-skill', 'namespace' => 'EngineerSkill'], function () {
    //================Begin-Technique Management===============================
    Route::group(['prefix' => 'technique'], function () {
        // 2015/04/01 HienNguyen Add start
        Route::any('/detail/{technique_id}', [
        'as' => 'technique-detail',
        'uses' => 'TechniqueController@getDetail'
        ]);
        // 2015/04/01 HienNguyen Add End
    });
    // 2015/04/01 My Vo Add start
    Route::group(['prefix' => 'engineer'], function() {
        Route::get('/add', [
        'as' => 'engineer-add',
        'uses' => 'EngineerController@index'
        ]);
        Route::group(['before' => 'csrf'], function() {
            Route::post('/add', [
            'as' => 'engineer-add-post',
            'uses' => 'EngineerController@add'
            ]);
            
            Route::put('/update_engineer/{engineer_id}', [
            'as' => 'engineer-update',
            'uses' => 'EngineerController@updateEngineer'
            ]);
        });
        Route::any('/detail/{engineer_id}', [
        'as' => 'engineer-detail',
        'uses' => 'EngineerController@getDetailEngineer'
        ]);
        
        Route::get('/list', [
            'as' => 'engineer-list',
            'uses' => 'EngineerController@getList'
        ]);
        
        Route::post('/list/ajax', [
            'as' => 'engineer-list-ajax',
            'uses' => 'EngineerController@getListAjax'
        ]);
        //2015/04/01 Bui Nguyen Update start
        Route::get('/interview-form/{engineer_id}/{has_form}', [
        'as' => 'interview-form',
        'uses' => 'InterviewController@interviewForm' 
        ]);
        Route::group(['before' => 'csrf'], function () {
	            Route::post('/create', [
	                'as'   => 'interview-create',
	                'uses' => 'InterviewController@submitInterviewForm'
	            ]);
                Route::put('/update', [
                    'as'   => 'interview-update',
                    'uses' => 'InterviewController@submitInterviewForm'
                ]);
        	});
        //2015/04/01 Bui Nguyen Update end
    });
    // 2015/04/01 My Vo Add end
    
    // 2015/04/02 LamKy -- show soft skill detail of engineer -- Add
    Route::any('/softskill-detail/{engineer_id}', [
        'as'    => 'softskill-detail',
        'uses'  => 'SoftSkillManagementController@getDetail'
    ]);
    // 2015/04/02 LamKy End

    // 2015/04/08 Nguyen trieu -- technical skill manager -- Add
    Route::group(['prefix' => 'technical-skill-manager'], function() {

        Route::get('/', [
            'as' => 'technical-skill-manager',
            'uses' => 'TechnicalSkillIndexController@index'
        ]);

        Route::get('/delete/{technique_id}', [
            'as' => 'technical-skill-manager-delete',
            'uses' => 'TechnicalSkillIndexController@doDelete'
        ]);

        Route::get('/create', [
            'as' => 'technical-skill-manager-create',
            'uses' => 'TechnicalSkillIndexController@create'
        ]);

        Route::post('/create', [
            'as' => 'technical-skill-manager-create',
            'uses' => 'TechnicalSkillIndexController@doCreate'
        ])->before('csrf');

        Route::get('/edit/{technique_id}', [
            'as' => 'technical-skill-manager-edit',
            'uses' => 'TechnicalSkillIndexController@edit'
        ]);

        Route::post('/edit/{technique_id}', [
            'as' => 'technical-skill-manager-edit',
            'uses' => 'TechnicalSkillIndexController@doEdit'
        ])->before('csrf');

    });
    // end
    
    // 2015/04/08 Nguyen trieu -- soft skill manager -- Add
    Route::group(['prefix' => 'soft-skill-manager'], function() {

        Route::get('/', [
            'as' => 'soft-skill-manager',
            'uses' => 'SoftSkillIndexController@index'
        ]);

        Route::get('/delete/{technique_id}', [
            'as' => 'soft-skill-manager-delete',
            'uses' => 'SoftSkillIndexController@doDelete'
        ]);

        Route::get('/create', [
            'as' => 'soft-skill-manager-create',
            'uses' => 'SoftSkillIndexController@create'
        ]);

        Route::post('/create', [
            'as' => 'soft-skill-manager-create',
            'uses' => 'SoftSkillIndexController@doCreate'
        ])->before('csrf');

        Route::get('/edit/{technique_id}', [
            'as' => 'soft-skill-manager-edit',
            'uses' => 'SoftSkillIndexController@edit'
        ]);

        Route::post('/edit/{technique_id}', [
            'as' => 'soft-skill-manager-edit',
            'uses' => 'SoftSkillIndexController@doEdit'
        ])->before('csrf');

    });
    // end
});


/**
 * Training Database Module
 */
Route::group(['before'=>'auth','prefix' => 'training-database', 'namespace' => 'TrainingDatabase'], function () {

    //================ 13-04-2015 [Begin-Trainer Management] by Nguyen Hien ===============================
    Route::group(['prefix' => 'trainer'], function () {

        Route::any("/list", [
                'as' => 'trainer-list',
                'uses' => "TrainerManagementController@getIndex"
        ]);

        //Ajax for datatable
        Route::any('/getList', [
                'as' => 'trainer-getList',
                'uses' => 'TrainerManagementController@getList'
        ]);

        /* QuynhMy: Update 2015/04/15 Start */
        Route::get("/add", [
        'as' => 'trainer-add',
        'uses' => "TrainerManagementController@getAdd"
        ]);
        Route::get('/edit/{trainer_id}', [
        'as' => 'trainer-detail',
        'uses' => 'TrainerManagementController@getDetailTrainer'
        ]);

        Route::group(['before' => 'csrf'], function() {
            
            Route::post("/add", [
            'as' => 'trainer-add-post',
            'uses' => "TrainerManagementController@addTrainer"
            ]);
            
            Route::post('/edit/{trainer_id}', [
            'as' => 'trainer-update',
            'uses' => 'TrainerManagementController@updateTrainer'
            ]);
        });
        
    });
    /* QuynhMy: Update 2015/04/15 End */
    //======================END-Trainer Management===========================
        
    //================Begin-Training Class===============================
    Route::group(['prefix' => 'training-class'], function () {
        //Ajax for datatable
        Route::post('/getList', [
            'as' => 'get-engineer-list',
            'uses' => 'TrainingClassController@getEngineerList'
        ]);

        Route::get("/assignEngineer/{id}", [
            'as' => 'assign-engineer',
            'uses' => "TrainingClassManagementController@getAssignEngineer"
        ]);
        
        /* 2014.04.14 Dung le Start */
        /* Training Class Management */
        // Training Class List
        Route::any('/list', [
            'as' => 'list-class',
            'uses' => 'TrainingClassManagementController@getClassesList'
        ]);
         // Training Class Detail
        Route::get('/edit/{class_id}', [
            'as' => 'edit-class',
            'uses' => 'TrainingClassManagementController@getClassDetail'
        ]);
        
        // Create Training Class
        Route::get('/create', [
            'as' => 'create-class',
            'uses' => 'TrainingClassManagementController@createTrainingClass'
        ]);
        
        Route::group(['before' => 'csrf'], function() {
            Route::put('/edit/{class_id}', [
                'as'    => 'edit-class-put',
                'uses'  => 'TrainingClassManagementController@doUpdate'
            ]);
            Route::post('/create', [
                'as'    => 'create-class-post',
                'uses'  => 'TrainingClassManagementController@doCreate'
            ]);
            Route::post("/assignEngineer/{id}", [
                'as' => 'store-assign-engineer',
                'uses' => "TrainingClassManagementController@postAssignEngineer"
            ]);
            Route::post("/create/course", [
                'as' => 'create-class-post-course',
                'uses' => "TrainingClassManagementController@addCourse"
            ]);
            Route::post("/create/trainer", [
                'as' => 'create-class-post-trainer',
                'uses' => "TrainingClassManagementController@addTrainer"
            ]);
        });
        /* 2014.04.14 Dung le End */
    });
    
    Route::group(['prefix' => 'course'], function () {
        Route::get('/', [
            'as'   => 'course-list',
            'uses' => 'CourseController@index'
        ]);
        //2015-04-15 tttu add start
        Route::post('/', [
           'as'   => 'course-list-ajax',
           'uses' => 'CourseController@getList'
        ]);
        //2015-04-15 tttu add end
        Route::post('/create', [
            'as'   => 'course-create',
            'uses' => 'CourseController@createCourse'
        ])->before('csrf');
        Route::get('/create', [
            'as'   => 'course-create',
            'uses' => 'CourseController@createCourse'
        ]);
        Route::get('/detail/{course_id}', [
            'as'   => 'course-detail',
            'uses' => 'CourseController@showCourseDetail'
        ]);
        Route::post('/detail/{course_id}', [
           'as'   => 'course-edit',
           'uses' => 'CourseController@editCourse'
        ])->before('csrf');
    });

    /* Nguyen Trieu: Update Technical Result --- START */
    Route::group(['prefix' => 'technical-result'], function () {
        Route::get('/list/{class_id}', [
            'as' => 'technical-result-list',
            'uses' => 'TechnicalResultController@lists'
        ]);
        Route::post('/list/{class_id}', [
            'as' => 'technical-result-list-ajax',
            'uses' => 'TechnicalResultController@listAjax'
        ]);
        Route::post('/update', [
            'as' => 'technical-result-update',
            'uses' => 'TechnicalResultController@updateResult'
        ]);
    });
    /* Nguyen Trieu: Update Technical Result --- END */

    /* Report module --- START */
    Route::group(['prefix' => 'report'], function () {
        Route::group(['prefix' => 'general-report'], function () {
            Route::get('/', [
                    'as' => 'general-report',
                    'uses' => 'TrainingGeneralReportController@index'
            ]);
            
            Route::post('/', [
                    'as' => 'general-report-post',
                    'uses' => 'TrainingGeneralReportController@postIndex'
            ]);
            
            Route::post('/export', [
                    'as' => 'general-report-export',
                    'uses' => 'TrainingGeneralReportController@doExport'
            ]);
        });
        
        Route::group(['prefix' => 'training-report'], function () {
            
        });
        Route::group(['prefix' => 'trainer-report'], function () {
            Route::get('/', [
                    'as' => 'trainer-report',
                    'uses' => 'TrainerReportController@index'
            ]);
            
            Route::post('/', [
                    'as' => 'trainer-report-post',
                    'uses' => 'TrainerReportController@postIndex'
            ]);
            
            Route::post('/export', [
                    'as' => 'trainer-report-export',
                    'uses' => 'TrainerReportController@doExport'
            ]);
        });
        Route::group(['prefix' => 'attendance-report'], function () {
            Route::get('/', [
                'as' => 'attendance',
                'uses' => 'AttendanceReportController@index'
            ]);
            Route::post('/', [
                'as' => 'attendance-post',
                'uses' => 'AttendanceReportController@preview'
            ]);
            Route::post('/export', [
                'as' => 'attendance-export',
                'uses' => 'TechnicalResultController@updateResult'
            ]);
            });
    });
    /* Report module --- START */
    //======================END-Training Class===========================
});

/**
 * Start Report Module 
 */
Route::group(['before'=>'auth', 'prefix' => 'report', 'namespace' => 'Report'], function() {
    /* Begin Techtical Skill Report */
    Route::group(['prefix' => 'tech'], function() {
        Route::get("/", [
                'as' => 'techtical-matrix-index',
                'uses' => "TechReportController@getIndex"
        ]);
    
        Route::post("/", [
                'as' => 'techtical-matrix',
                'uses' => "TechReportController@postIndex"
        ]);
    
        Route::post("/export", [
                'as' => 'techtical-matrix-report',
                'uses' => "TechReportController@postExportExcel"
        ])->before('csrf');
    });
    /* End Techtical Skill Report */

    /* Begin Monthly Utilization Report */
    Route::group(['prefix' => 'utilization'], function() {
        Route::get('/', [
                'as' => 'utilization-get',
                'uses' => 'UtilizationController@index'
        ]);

        Route::post('/', [
                'as' => 'utilization-post',
                'uses' => 'UtilizationController@postIndex'
        ])->before('csrf');

        Route::post('/export', [
                'as' => 'utilization-export',
                'uses' => 'UtilizationController@postExport'
        ])->before('csrf');;
    });
        /* End Monthly Utilization Report */
});
/**
 * End Report Module 
 */

// 2015/04/06 tttu add start
/**
 * Import Utilization  Module
 */
Route::group(['before'=>'auth','prefix' => 'import', 'namespace' => 'Import'], function () {

    Route::get( "utilization", [
        'as' => 'import-utilization',
        'uses' => "UtilizationImportController@index"
    ]);

    Route::get("utilization/index", [
        'as' => 'import-utilization-index',
        'uses' => "UtilizationImportController@index"
    ]);

    Route::group(['before' => 'csrf'], function() {
        Route::post('utilization', [
            'as' => 'import-utilization',
            'uses' => 'UtilizationImportController@import'
        ]);
    });
});
// 2015/04/06 tttu add end

/**
 * User Management
 */

Route::group(['before'=>'auth','prefix' => 'users', 'namespace' => 'UserManagement'], function () {

  Route::get('/list', [
    'as' => 'user-list',
    'uses' => 'UserController@index'
  ]);

  Route::group(['before'=>'permission'],function(){
      Route::get('/add', [
        'as' => 'user-add',
        'uses' => 'UserController@create',
      ]);
      
  });
  Route::group(['before'=>'permission-custom'],function(){
    Route::get('edit/{id}', [
      'as' => 'user-edit',
      'uses' => 'UserController@edit'
    ]);
    Route::get('detail/{id}', [
      'as' => 'user-detail',
      'uses' => 'UserController@show'
    ]);
    Route::get('change-password/{id}', [
      'as' => 'user-change-password',
      'uses' => 'UserController@changePassword'
    ]);
    Route::get('reset-password/{id}', [
      'as' => 'user-reset-password',
      'uses' => 'UserController@resetPassword'
    ]);
  });
  //Ajax for datatable
  Route::post('/getList', [
    'as' => 'get-user-list',
    'uses' => 'UserController@getList'
  ]);

  Route::group(['before' => 'csrf'], function () {
    Route::post('/store', [
     'as' => 'user-store',
     'uses' => 'UserController@store'
    ]);
    Route::post('/update/{id}', [
     'as' => 'user-update',
     'uses' => 'UserController@update'
    ]);
    Route::post('/ChangePassword/{id}', [
     'as' => 'user-excute-change-password',
     'uses' => 'UserController@excuteChangePassword'
    ]);
    Route::post('/ResetPassword/{id}', [
     'as' => 'user-excute-reset-password',
     'uses' => 'UserController@excuteResetPassword'
    ]);
  });
  
});