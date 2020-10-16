<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// admin routes
Route::group(['prefix' => 'administration-gate'], function () {

    // get login route
    Route::get('/', [
        'as'    => 'admin-login',
        'uses'  => 'AdminAuth@getLogin',
    ]);

    // post login route
    Route::post('/', [
        'as'    => 'post-admin-login',
        'uses'  => 'AdminAuth@postLogin',
    ]);

    // get logout
    Route::get('logout', [
        'as'    => 'admin-logout',
        'uses'  => 'AdminAuth@getLogout',
    ]);

    // admin auth route
    Route::group(['prefix' => 'access', 'middleware' => 'adminauth'], function () {

        // get dashboard
        Route::get('/', [
            'as'    => 'admin-dashboard',
            'uses'  => 'AdminDashboard@index',
        ]);

        /* user mgmt routes */
        Route::get('user-management', [
            'as'    => 'get-users',
            'uses'  => 'UserManagement@index',
        ]);

        // search user route
        Route::post('user-management', [
            'as'    => 'search-user',
            'uses'  => 'UserManagement@searchUser',
        ]);

        // modify user status
        Route::get('user-status/{id}', [
            'as' => 'user-status',
            'uses' => 'UserManagement@userStatus',
        ]);

        // view user record
        Route::get('user-record/{id}', [
            'as' => 'user-record',
            'uses' => 'UserManagement@userRecord',
        ]);

        // Route for COURSE MANAGEMENT
        Route::get('course', [
            'as' => 'user-course',
            'uses' => 'CourseManagement@index',
        ]);

        // search course
        Route::post('course', [
            'as' => 'search-course',
            'uses' => 'CourseManagement@searchCourse',
        ]);


        // modify course status
        Route::get('course/status/{id}', [
            'as' => 'course-status',
            'uses' => 'CourseManagement@courseStatus',
        ]);

        // add course
        Route::get('add-course', [
            'as' => 'add-course',
            'uses' => 'CourseManagement@addCourse',
        ]);

        Route::post('add-course', [
            'as' => 'post-add-course',
            'uses' => 'CourseManagement@postAddCourse',
        ]);

        // edit course
        Route::get('edit-course\{id}', [
            'as' => 'edit-course',
            'uses' => 'CourseManagement@editCourse',
        ]);

        Route::post('edit-course', [
            'as' => 'post-edit-course',
            'uses' => 'CourseManagement@postEditCourse',
        ]);

        // view course info
        Route::get('view-course/{id}', [
            'as' => 'view-course',
            'uses' => 'CourseManagement@viewCourse',
        ]);

        // Route for classes
        Route::group(['prefix' => 'classes'], function() {
            Route::get('/', [
                'as' => 'user-class',
                'uses' => 'ClassManagement@index',
            ]);

            Route::post('/', [
                'as' => 'search-class',
                'uses' => 'ClassManagement@searchClass',
            ]);

            Route::get('add-class', [
                'as' => 'add-class',
                'uses' => 'ClassManagement@addClass',
            ]);

            Route::post('add-class', [
                'as' => 'post-add-class',
                'uses' => 'ClassManagement@postAddClass',
            ]);

        });

        Route::group(['prefix' => 'resources'], function () {
            Route::get('/', [
                'as' => 'user-resource',
                'uses' => 'ResourceManagement@index',
            ]);

            Route::post('/', [
                'as' => 'search-user-resource',
                'uses' => 'ResourceManagement@searchResource',
            ]);

            Route::get('add-resource', [
                'as' => 'add-resource',
                'uses' => 'ResourceManagement@addResource',
            ]);

            Route::post('add-resource', [
                'as' => 'post-add-resource',
                'uses' => 'ResourceManagement@postAddResource',
            ]);

        });

       Route::group(['prefix' => 'settings'], function () {
            Route::get('change-password', [
                'as' => 'admin-settings',
                'uses' => 'SettingsManagement@index',
            ]);

            Route::post('change-password', [
                'as' => 'post-admin-settings',
                'uses' => 'SettingsManagement@changePassword',
            ]);
       });

       Route::group(['prefix' => 'administrator'], function () {
            Route::get('/', [
                'as' => 'get-admin',
                'uses' => 'AdminManagement@index',
            ]);

            Route::post('/', [
                'as' => 'search-admin',
                'uses' => 'AdminManagement@searchAdmin',
            ]);

           Route::get('add-admin', [
               'as' => 'add-admin',
               'uses' => 'AdminManagement@addAdmin',
           ]);

           Route::post('add-admin', [
               'as' => 'post-add-admin',
               'uses' => 'AdminManagement@store',
           ]);
       });

    //    investment route
       Route::group(['prefix' => 'investment'], function(){
           Route::get('/', [
               'as' => 'user-investment',
               'uses' => 'InvestmentManagement@index',
           ]);

           Route::get('status/{id}', [
               'as' => 'investment-status',
               'uses' => 'InvestmentManagement@modifyStatus',
           ]);

           Route::get('add', [
               'as' => 'add-investment',
               'uses' => 'InvestmentManagement@addInvestment',
           ]);

           Route::post('add', [
               'as' => 'post-add-investment',
               'uses' => 'InvestmentManagement@postAddInvestment',
           ]);

           Route::get('edit/{id}', [
               'as' => 'edit-investment',
               'uses' => 'InvestmentManagement@editInvestment',
           ]);

           Route::post('edit', [
               'as' => 'post-edit-investment',
               'uses' => 'InvestmentManagement@postEditInvestment',
           ]);

           Route::get('view/{id}', [
               'as' => 'view-investment',
               'uses' => 'InvestmentManagement@viewInvestment',
           ]);

           Route::post('pay-all', [
               'as' => 'pay-all',
               'uses' => 'InvestmentManagement@payAll',
           ]);

           Route::get('pay/user/{id}', [
                'as' => 'pay-user',
                'uses' => 'InvestmentManagement@payUser',
           ]);
           
       });

       Route::group(['prefix' => 'notification'], function () {
           Route::get('/', [
               'as' => 'user-notification',
               'uses' => 'NotificationManagement@index',
           ]);

           Route::post('/', [
               'as' => 'notification-search',
               'uses' => 'NotificationManagement@search'
           ]);

           Route::get('create/notification', [
               'as' => 'create-notification',
               'uses' => 'NotificationManagement@create',
           ]);

           Route::post('create/notification', [
               'as' => 'post-create-notification',
               'uses' => 'NotificationManagement@store',
           ]);

           Route::get('status/{id}', [
                'as' => 'notification-status',
                'uses' => 'NotificationManagement@status',
            ]);

       });

    });

});
// end admin routes

// user loggedin routes
Route::get('/', [
    'as' => 'get-user-home',
    'uses' => 'UserAuthController@index',
]);

Route::get('terms-of-use', [
    'as' => 'get-terms-of-use',
    'uses' => 'UserAuthController@getTerms',
]);

Route::get('/privacy-use', [
    'as' => 'get-privacy',
    'uses' => 'UserAuthController@getPrivacy',
]);

Route::get('/authenticate/{id}', [
    'as' => 'auth-transaction',
    'uses' => 'IndexPaymentController@payInvestment',
]);

Route::get('/authenticate/pay/{id}', [
    'as' => 'index-investment-payment',
    'uses' => 'IndexPaymentController@payNow',
]);

Route::get('authenticate/pay/confirmation/{id}', [
    'as' => 'investment-pay-confirmation',
    'uses' => 'IndexPaymentController@verifyInnvestmentPayment',
]);

// user purchase course and authentication
Route::get('authenticate/course/{id}', [
    'as' => 'verify-course-purchase',
    'uses' => 'IndexCoursePayment@verifyCourse'
]);



Route::get('/login', [
    'as' => 'get-user-login',
    'uses' => 'UserAuthController@getLogin',
]);

Route::post('/login', [
    'as' => 'post-user-login',
    'uses' => 'UserAuthController@postLogin',
]);

Route::get('/recover-password', [
    'as' => 'recover-password',
    'uses' => 'UserAuthController@recoverPassword',
]);

Route::post('/recover-password', [
    'as' => 'post-recover-password',
    'uses' => 'UserAuthController@postRecoverPassword',
]);

Route::get('/recover-password/verify/token/{id}', [
    'as' => 'recover-password-verify-token',
    'uses' => 'UserAuthController@recoverPasswordVerifyToken',
]);

Route::post('/recover-password/very/token', [
    'as' => 'reset-password',
    'uses' => 'UserAuthController@resetPassword',
]);

// registration step 1
Route::get('/register', [
    'as' => 'get-user-register',
    'uses' => 'UserAuthController@getRegister'
]);

Route::post('/register', [
    'as' => 'post-register-one',
    'uses' => 'UserAuthController@postRegisterOne',
]);

// registration step 2
Route::get('/register/step-2', [
    'as' => 'get-user-register-step-two',
    'uses' => 'UserAuthController@getRegisterTwo',
]);

Route::post('/register/step-2', [
    'as' => 'post-user-register-step-two',
    'uses' => 'UserAuthController@postRegisterTwo',
]);

// registration step 3
Route::get('/register/step-3', [
    'as' => 'get-user-register-step-three',
    'uses' => 'UserAuthController@getRegisterThree',
]);

Route::post('/register/step-3', [
    'as' => 'post-user-register-step-three',
    'uses' => 'UserAuthController@postRegisterThree',
]);


Route::get('/about', [
    'as' => 'get-user-about',
    'uses' => 'UserAuthController@getAbout',
]);

Route::get('/logout', [
    'as' => 'get-user-logout',
    'uses' => 'UserAuthController@getLogout',
]);

Route::group(['prefix' => 'logged-in', 'middleware' => 'userauth'], function() {
    Route::get('/', [
        'as' => 'get-user-dashboard',
        'uses' => 'UserDashboardController@index',
    ]);

    Route::get('/authenticate/pay/{id}', [
        'as' => 'index-investment-payment',
        'uses' => 'IndexPaymentController@payNow',
    ]);
    
    Route::get('/authenticate/pay/confirmation/{id}', [
        'as' => 'investment-pay-confirmation',
        'uses' => 'IndexPaymentController@verifyInnvestmentPayment',
    ]);

    Route::get('/authenticate/pay/confirmation/check/{investment_id}/{slot}', [
        'as' => 'investment-slot-deduction',
        'uses' => 'Helper@slotDeduction',
    ]);

    // user purchase course page
    Route::get('authenticate/course/purchase/{id}', [
        'as' => 'purchase-course',
        'uses' => 'IndexCoursePayment@purchaseCourse',
    ]);

    // upload user purchased course
    Route::post('authenticate/course/purchase', [
        'as' => 'upload-user-purchased-course',
        'uses' => 'IndexCoursePayment@uploadUserCourse',
    ]);

    // verify course purchase
    Route::get('verify/course/purchase/{id}', [
        'as' => 'verify-course-added',
        'uses' => 'IndexCoursePayment@verifyCoursePurchase'
    ]);

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [
            'as' => 'get-user-profile',
            'uses' => 'UserProfileController@index',
        ]);

        Route::get('edit', [
            'as' => 'get-edit-user-profile',
            'uses' => 'UserProfileController@edit',
        ]);

        Route::post('edit', [
            'as' => 'post-edit-user-profile',
            'uses' => 'UserprofileController@postEdit',
        ]);

        Route::get('settings', [
            'as' => 'get-user-settings',
            'uses' => 'UserProfileController@settings',
        ]);

        Route::post('settings', [
            'as' => 'post-user-settings',
            'uses' => 'UserProfileController@postChangePassword',
        ]);

        Route::post('settings/bank', [
            'as' => 'post-change-bank',
            'uses' => 'UserProfileController@postChangeBank',
        ]);
    });

    Route::group(['prefix' => 'resource'], function () {
        Route::get('/', [
            'as' => 'get-user-resource',
            'uses' => 'UserResourceController@index',
        ]);

        Route::post('/', [
            'as' => 'search-user-resource',
            'uses' => 'UserResourceController@search',
        ]);
    });

    Route::group(['prefix' => 'class'], function () {
        Route::get('/', [
            'as' => 'get-user-class',
            'uses' => 'UserClassController@index',
        ]);
    });

    Route::group(['prefix' => 'notification'], function () {
        Route::get('/', [
            'as' => 'get-user-notification',
            'uses' => 'UserNotificationController@index',
        ]);
    });

    Route::group(['prefix' => 'investment'], function () {
        Route::get('/', [
            'as' => 'get-user-investment',
            'uses' => 'UserInvestmentController@index',
        ]);

        Route::get('/pay/{id}', [
            'as' => 'user-investment-pay',
            'uses' => 'UserInvestmentController@investmentPay',
        ]);

        Route::get('/pay/verify-payment/{id}', [
            'as' => 'verify-user-payent',
            'uses' => 'UserInvestmentController@verifyPayment',
        ]);

        Route::post('/pay/verify-payment', [
            'as' => 'create-user-investment',
            'uses' => 'UserInvestmentController@createUserInvestment',
        ]);

        Route::get('pay/verify-user-investment/{id}', [
            'as' => 'verify-user-investment',
            'uses' => 'UserInvestmentController@verifyUserInvestment',
        ]);

    });
});
// end user routes
