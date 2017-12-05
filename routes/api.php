<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:api'])->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/user/characters', 'Coc\CharactersController@getOwned');
    Route::get('/user/groups', 'Coc\GroupsController@getOwned');

    Route::get('/characters', 'Coc\CharactersController@get');
    Route::get('/characters/page/{page?}', 'Coc\CharactersController@getPagenated');
    Route::get('/characters/{id}', 'Coc\CharactersController@getById');
    Route::get('/characters/{id}/owned', 'Coc\CharactersController@getByIdWithGuard');
    Route::post('/characters/create', 'Coc\CharactersController@create');
    Route::post('/characters/update/{id}', 'Coc\CharactersController@update');

    Route::get('/groups', 'Coc\GroupsController@get');
    Route::get('/groups/{id}', 'Coc\GroupsController@find');
    Route::post('/groups/create', 'Coc\GroupsController@create');
    Route::post('/groups/update/{id}', 'Coc\GroupsController@update');
    Route::post('/groups/delete/{id}', 'Coc\GroupsController@delete');
    Route::post('/groups/{id}/add', 'Coc\GroupsController@add');
    Route::post('/groups/{id}/addAll', 'Coc\GroupsController@addAll');
    Route::post('/groups/{id}/remove', 'Coc\GroupsController@add');

    Route::get('/skills', 'Coc\SkillsController@getAsOptions');

    Route::get('/skillsets', 'Coc\SkillsetsController@get');
    Route::get('/skillsets/{id}', 'Coc\SKillsetsController@find');
});
