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

Route::get('/', 'Controller@index')->name('index');


Route::group(['middleware' => ['auth']], function() {
    Route::group(['prefix' => 'groups'], function()
    {
        Route::get('', 'GroupController@index')->name('group_index');
        Route::get('group/{group_id}', 'GroupController@showgroup')->name('group_show');
        Route::get('new', 'GroupController@newgroup')->name('group_new');
        Route::post('new', 'GroupController@creategroup')->name('group_create');
        Route::get('group/{group_id}/modify', 'GroupController@modifygroup')->name('group_modify');
        Route::post('group/{group_id}/modify', 'GroupController@updategroup')->name('group_update');

        Route::post('group/newtask', 'GroupController@addtask')->name('task_add');
        Route::get('group/dotask/{task_id}', 'GroupController@dotask')->name('task_do');
        Route::get('group/undotask/{task_id}', 'GroupController@undotask')->name('task_undo');
        Route::get('group/completetask/{task_id}', 'GroupController@completetask')->name('task_complete');
        Route::get('group/opentask/{task_id}', 'GroupController@opentask')->name('task_open');
        Route::get('group/deletetask/{task_id}', 'GroupController@deletetask')->name('task_delete');

        Route::post('group/search_groupmember', 'GroupController@searchgroupmember')->name('group_search_groupmember');
        Route::get('group/{group_id}/add_groupmember/{user_id}', 'GroupController@addgroupmember')->name('group_add_groupmember');
        Route::get('group/{group_id}/remove_groupmember/{user_id}', 'GroupController@removegroupmember')->name('group_remove_groupmember');


    });

    Route::group(['prefix' => 'profile'], function() {
        Route::get('{user_id}', 'UserController@showuser')->name('profile');
        Route::post('updateavatar', 'UserController@updateavatar')->name('update_avatar');

        Route::get('{user_id}/messages', 'MessageController@index')->name('messages');
    });
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
});



Auth::routes();


