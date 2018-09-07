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

#Route::get('/students/delete/{id}', "studentsController@studentsDeleting");

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

// Student -- Request Auto Document
Route::get('/students/request/{id}', "studentsController@studentsRequestSite");

Route::post('/students/request', "studentsController@studentsRequest");

// End Students Controller
//
//
//
//
// Definitions Controller
Route::get('/definitions', "definitionsController@definitionsSettingSite");

Route::get('/definitions/add', "definitionsController@definitionsAddingSite");

Route::post('/definitions/add', "definitionsController@definitionsAdding");

Route::get('/definitions/delete/{id}', "definitionsController@definitionsDeleting")->middleware('checkLevel');

Route::get('/definitions/edit/{id}', "definitionsController@definitionsEditingSite")->middleware('checkLevel');

Route::post('/definitions/edit', "definitionsController@definitionsEditing")->middleware('checkLevel');

Route::get('definitions/changePos/up/{position}', "definitionsController@definitionsChangePositionUp")->middleware('checkLevel');;

Route::get('definitions/changePos/down/{position}', 'definitionsController@definitionsChangePositionDown')->middleware('checkLevel');;

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

// End Documents Controller
//
//
//
//
// Files Controller
Route::get('files', 'filesController@filesViewingSite');

Route::get('files/delete/{id}', 'filesController@filesDeleting');

Route::post('files/add', 'filesController@filesAdding');

// End Files Controller
//
//
//
//
// Group Files Controller
Route::get('/groupFiles', "groupFilesController@groupFilesSettingSite");

Route::get('/groupFiles/add', "groupFilesController@groupFilesAddingSite");

Route::post('/groupFiles/add', "groupFilesController@groupFilesAdding");

Route::get('/groupFiles/edit/{id}', "groupFilesController@groupFilesEditingSite");

Route::post('/groupFiles/edit', "groupFilesController@groupFilesEditing");

Route::get('/groupFiles/view/{id}', "groupFilesController@groupFilesViewingSite");

Route::get('/groupFiles/delete/{id}', "groupFilesController@groupFilesDeleting");

// End Group Files Controller
//
//
//
//
// Translations Controll
Route::get('/translations/{id}', "translationsController@translationsSettingSite");

Route::post('/translations', "translationsController@translationsSetting");

// End Translations Controller
//
//
//
//
// Employees Controll
Route::get('/employees', "employeesController@employeesSettingSite");

Route::post('/employees/add', "employeesController@employeesAdding");

Route::get('/employees/view/{id}', "employeesController@employeesViewingSite");

Route::post('/employees/edit', "employeesController@employeesEdit");

Route::post('/employees/addStudent', "employeesController@employeesAddStudent");

Route::get('/employees/rmStudent/{employee_id}/{student_id}', "employeesController@employeesRmStudent");

// Auth
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
