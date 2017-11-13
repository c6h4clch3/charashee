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

    Route::get('/characters/{page?}', 'Coc\CharactersController@get');

    Route::get('/groups', 'Coc\GroupsController@get');
    Route::get('/groups/{id}', 'Coc\GroupsController@find');
    Route::post('/groups/create', 'Coc\GroupsController@create');

    Route::get('/skillsets', 'Coc\SkillsetsController@get');
    Route::get('/skillsets/{id}', 'Coc\SKillsetsController@find');
});
