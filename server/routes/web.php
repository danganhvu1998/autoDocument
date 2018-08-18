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

Route::get('/', function () {
    return view('welcome');
});

// Students Controller
Route::get('/students', "studentsController@studentsShowingSite");

Route::get('/students/add', "studentsController@studentsAddingSite");

Route::post('/students/add', "studentsController@studentsAdding");

Route::get('/students/delete/{id}', "studentsController@studentsDeletingSite");

Route::get('/students/view/{id}', "studentsController@studentsViewingSite");

Route::get('/students/edit/{id}', "studentsController@studentsEditingSite");

Route::post('/students/edit', "studentsController@studentsEditing");

// Definitions Controller
Route::get('/definitions', "definitionsController@definitionsSettingSite");

Route::get('/definitions/add', "definitionsController@definitionsAddingSite");

Route::post('/definitions/add', "definitionsController@definitionsAdding");

Route::get('/definitions/delete/{id}', "definitionsController@definitionsDeletingSite");

Route::get('/definitions/edit/{id}', "definitionsController@definitionsEditingSite");

Route::post('/definitions/edit', "definitionsController@definitionsEditing");

// Auth
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
