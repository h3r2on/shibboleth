<?php

Route::group(['as' => 'auth::', 'prefix' => 'auth'], function() {
	// Login Route
	Route::get('login', ['as' => 'login', 'uses' => 'H3r2on\Shibboleth\Http\AuthController@create']);
	// Logout Route
	Route::get('logout', [ 'as' => 'logout', 'uses' => 'H3r2on\Shibboleth\Http\AuthController@destroy']);
	// Shibboleth IdP Callback
	Route::get('idp', ['as' => 'callback', 'uses' => 'H3r2on\Shibboleth\Http\AuthController@idpAuthorize']);
});
