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

Route::get('/students/delete/{id}', "studentsController@studentsDeleting");

Route::get('/students/view/{id}', "studentsController@studentsViewingSite");

Route::get('/students/edit/{id}', "studentsController@studentsEditingSite");

Route::post('/students/edit', "studentsController@studentsEditing");

Route::get('/students/check/{id}', "studentsController@studentsCheckingSite");

// Student -- Note
Route::get('/students/note/view/{id}', "studentsController@studentsNoteViewingSite");

Route::get('/students/note/edit/{id}', "studentsController@studentsNoteEditingSite");

Route::post('/students/note/edit', "studentsController@studentsNoteEditing");

Route::get('/students/note/add/{id}', "studentsController@studentsNoteAddingSite");

Route::post('/students/note/add', "studentsController@studentsNoteAdding");

Route::get('/students/note/delete/{studentID}/{noteID}', "studentsController@studentsNoteDeleting");

// Student -- Document
Route::get('/students/document/edit/{documentID}/{studentID}', "studentsController@studentsDocumentEditingSite");

Route::post('/students/document/edit', "studentsController@studentsDocumentEditing");

Route::get('/students/document/view/{documentID}/{studentID}', "studentsController@studentsDocumentViewingSite");

// End Students Controller
//
//
//
//
// Definitions Controller
Route::get('/definitions', "definitionsController@definitionsSettingSite");

Route::get('/definitions/add', "definitionsController@definitionsAddingSite");

Route::post('/definitions/add', "definitionsController@definitionsAdding");

Route::get('/definitions/delete/{id}', "definitionsController@definitionsDeleting");

Route::get('/definitions/edit/{id}', "definitionsController@definitionsEditingSite");

Route::post('/definitions/edit', "definitionsController@definitionsEditing");

Route::get('definitions/changePos/up/{position}', "definitionsController@definitionsChangePositionUp");

Route::get('definitions/changePos/down/{position}', 'definitionsController@definitionsChangePositionDown');

Route::get('definitions/changePos/reset', 'definitionsController@definitionsResetPosition');

// End Definitions Controller
//
//
//
//
// Documents Controller
Route::get('/documents', "documentsController@documentsSettingSite");

Route::get('/documents/add', "documentsController@documentsAddingSite");

Route::post('/documents/add', "documentsController@documentsAdding");

Route::get('/documents/edit/{id}', "documentsController@documentsEditingSite");

Route::post('/documents/edit', "documentsController@documentsEditing");

Route::get('/documents/view/{id}', "documentsController@documentsViewingSite");

Route::get('/documents/delete/{id}', "documentsController@documentsDeleting");

// Auth
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
