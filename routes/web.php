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


use Illuminate\Support\Facades\Route;

Route::get('/', 'SiteController@index')->name('welcome');
Route::get('workplaces', 'WorkplacesController@index')->name('workplaces.index');
Route::get('workplaces/create', 'WorkplacesController@create')->name('workplaces.create');
Route::post('workplaces/store', 'WorkplacesController@store')->name('workplaces.store');
Route::get('workplaces/{id}/show', 'WorkplacesController@show')->name('workplaces.show');
Route::get('workplaces/{id}/edit', 'WorkplacesController@edit')->name('workplaces.edit');
Route::post('workplaces/{id}/update', 'WorkplacesController@update')->name('workplaces.update');
Route::post('workplaces/{id}/destroy', 'WorkplacesController@destroy')->name('workplaces.destroy');

Route::get('workplaces/{id}/create_box', 'WorkplacesController@create_box')->name('workplaces.create_box');
Route::get('workplaces/{id}/create_boxes', 'WorkplacesController@create_boxes')->name('workplaces.create_boxes');
Route::post('workplaces/{id}/store_boxes', 'WorkplacesController@store_boxes')->name('workplaces.store_boxes');


Route::get('boxes/{id}/show', 'BoxesController@show')->name('boxes.show');
Route::get('boxes/{id}/create_cell', 'BoxesController@create_cell')->name('boxes.create_cell');
Route::post('boxes/{id}/store_cell', 'BoxesController@store_cell')->name('boxes.store_cell');
Route::post('boxes/{id}/destroy', 'BoxesController@destroy')->name('boxes.destroy');
Route::get('boxes/{id}/edit', 'BoxesController@edit')->name('boxes.edit');
Route::post('boxes/{id}/update', 'BoxesController@update')->name('boxes.update');


Route::get('cells/{id}/show', 'CellsController@show')->name('cells.show');
Route::get('cells/{id}/edit', 'CellsController@edit')->name('cells.edit');
Route::post('cells/{id}/update', 'CellsController@update')->name('cells.update');
Route::post('cells/{id}/destroy', 'CellsController@destroy')->name('cells.destroy');
Route::get('cells/{id}/create_folder', 'CellsController@create_folder')->name('cells.create_folder');
Route::post('cells/{id}/store_folder', 'CellsController@store_folder')->name('cells.store_folder');


Route::get('folders', 'FoldersController@index')->name('folders.index');
Route::get('folders/create', 'FoldersController@create')->name('folders.create');
Route::post('folders/{id}/destroy', 'FoldersController@destroy')->name('folders.destroy');
Route::get('folders/{id}/show', 'FoldersController@show')->name('folders.show');
Route::get('folders/{id}/edit', 'FoldersController@edit')->name('folders.edit');
Route::post('folders/{id}/update', 'FoldersController@update')->name('folders.update');
Route::post('folders/{id}/destroy', 'FoldersController@destroy')->name('folders.destroy');
Route::get('folders/{id}/create_document', 'FoldersController@create_document')->name('folders.create_document');

Route::get('folders/get_boxes/{id}', 'FoldersController@get_boxes')->name('folders.get_boxes');
Route::get('folders/get_cells/{id}', 'FoldersController@get_cells')->name('folders.get_cells');
Route::get('folders/get_workplaces', 'FoldersController@get_workplaces')->name('folders.get_workplaces');

Route::post('folders/store', 'FoldersController@store')->name('folders.store');
Route::post('folders/{id}/store_document', 'FoldersController@store_document')->name('folders.store_document');


Route::get('documents', 'DocumentsController@index')->name('documents.index');
Route::get('documents/create', 'DocumentsController@create')->name('documents.create');
Route::post('documents/store', 'DocumentsController@store')->name('documents.store');
Route::get('documents/{id}/show', 'DocumentsController@show')->name('documents.show');
Route::get('documents/{id}/edit', 'DocumentsController@edit')->name('documents.edit');
Route::post('documents/{id}/destroy', 'DocumentsController@destroy')->name('documents.destroy');
Route::post('documents/{id}/update', 'DocumentsController@update')->name('documents.update');




Route::any('search', 'SiteController@search')->name('search');
