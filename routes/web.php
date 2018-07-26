<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

#Contacts
Route::resource('contacts', 'ContactsController');

#Todos
Route::resource('todos', 'TodosController');

#Journals
Route::resource('journals', 'JournalsController');

#ContactConversation
Route::resource('contacts.conversations', 'ContactConversationsController');