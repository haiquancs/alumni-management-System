<?php

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

Route::match(['get', 'post'], '/', function () {
    return redirect()->route('web.auth.login');
});
Route::match(['GET', 'POST'], 'login', 'Web\AuthController@login')->name('web.auth.login');
Route::match(['GET', 'POST'], 'create', 'Web\AuthController@create')->name('web.auth.create');
Route::match(['GET', 'POST'], 'logout', 'Web\AuthController@logout')->name('web.auth.logout');

Route::middleware(['AuthStaff'])
    ->namespace('Web')
    ->group(function () {
        //Route for StaffsController
        Route::resource('users', 'UsersController', ['names' => [
            'index' => 'web.users.index',
            'create' => 'web.users.create',
            'store' => 'web.users.store',
            'show' => 'web.users.show',
            'edit' => 'web.users.edit',
            'update' => 'web.users.update',
            'destroy' => 'web.users.destroy',
        ]]);
        Route::match(['GET', 'POST'], 'changePassword', 'UsersController@changePassword')->name('web.users.changePassword');
        //Other Router
        //.....

        Route::resource('surveys', 'SurveysController', ['names' => [
            'index' => 'web.surveys.index',
            'create' => 'web.surveys.create',
            'store' => 'web.surveys.store',
            'show' => 'web.surveys.show',
            'edit' => 'web.surveys.edit',
            'update' => 'web.surveys.update',
            'destroy' => 'web.surveys.destroy',
        ]]);

        Route::get('manage-opes','OpesController@manageOpes')->name('web.opes.manage-opes');
        Route::get('all-opes','OpesController@opesStaff')->name('web.opes.opes-staff');
        Route::get('approval/{idOpesStaff}/{idStaff}', 'OpesController@approval')->name('web.opes.approval');
        Route::get('rejected/{idOpesStaff}/{idStaff}', 'OpesController@rejected')->name('web.opes.rejected');
        Route::get('export-opes/{idOpesStaff}','OpesController@exportOpes')->name('web.opes.export-opes');
        Route::get('export-manage-opes-staff','OpesController@exportManageOpesStaff')->name('web.opes.export-manage-opes-staff');
        Route::get('export-all-opes-staff','OpesController@exportAllOpesStaff')->name('web.opes.export-all-opes-staff');
        Route::get('export-user','UsersController@exportUser')->name('web.users.export-user');

        Route::resource('evaluation-criterias', 'EvaluationCriteriasController', ['names' => [
            'index' => 'web.evaluation-criterias.index',
            'create' => 'web.evaluation-criterias.create',
            'store' => 'web.evaluation-criterias.store',
            'show' => 'web.evaluation-criterias.show',
            'edit' => 'web.evaluation-criterias.edit',
            'update' => 'web.evaluation-criterias.update',
            'destroy' => 'web.evaluation-criterias.destroy',
        ]]);

        Route::resource('departments', 'DepartmentsController', ['names' => [
            'index' => 'web.departments.index',
            'create' => 'web.departments.create',
            'store' => 'web.departments.store',
            'show' => 'web.departments.show',
            'edit' => 'web.departments.edit',
            'update' => 'web.departments.update',
            'destroy' => 'web.departments.destroy',
        ]]);

        Route::resource('ranks', 'RanksController', ['names' => [
            'index' => 'web.ranks.index',
            'create' => 'web.ranks.create',
            'store' => 'web.ranks.store',
            'show' => 'web.ranks.show',
            'edit' => 'web.ranks.edit',
            'update' => 'web.ranks.update',
            'destroy' => 'web.ranks.destroy',
        ]]);

        Route::resource('grades', 'GradesController', ['names' => [
            'index' => 'web.grades.index',
            'create' => 'web.grades.create',
            'store' => 'web.grades.store',
            'show' => 'web.grades.show',
            'edit' => 'web.grades.edit',
            'update' => 'web.grades.update',
            'destroy' => 'web.grades.destroy',
        ]]);

        Route::resource('request', 'RequestsController', ['names' => [
            'index' => 'web.request.index',
            'create' => 'web.request.create',
            'store' => 'web.request.store',
            'show' => 'web.request.show',
            'edit' => 'web.request.edit',
            'update' => 'web.request.update',
            'destroy' => 'web.request.destroy',
        ]]);

        Route::resource('document', 'DocumentsController', ['names' => [
            'index' => 'web.document.index',
            'create' => 'web.document.create',
            'store' => 'web.document.store',
            'show' => 'web.document.show',
            'edit' => 'web.document.edit',
            'update' => 'web.document.update',
            'destroy' => 'web.document.destroy',
        ]]);
    });
