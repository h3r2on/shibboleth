<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Shibboleth Endpoints
    |--------------------------------------------------------------------------
    |
    | Sets your URIs to your SP
    |
    */

		'idp_login'         => env('IDP_LOGIN', '/Shibboleth.sso/Login'),
		'idp_logout'        => env('IDP_LOGOUT', '/Shibboleth.sso/Logout'),

		/*
		|--------------------------------------------------------------------------
		| Shibboleth Routes
		|--------------------------------------------------------------------------
		|
		| Set the Route names for successful authentication and
		| failed authentication with the IDP
		*/

		'idp_authenticated' => env('IDP_AUTHENTICATED', 'dashboard'),
		'idp_unauthorized'  => env('IDP_UNAUTHORIZED', 'unauthorized'),

		/*
		|--------------------------------------------------------------------------
		| User Attribute Mapping
		|--------------------------------------------------------------------------
		*/

		'idp_login_email'   => env('IDP_LOGIN_MAIL','mail'),
		'idp_login_first'   => env('IDP_LOGIN_FIRST','givenName'),
		'idp_login_last'    => env('IDP_LOGIN_LAST', 'sn'),

		/*
		|--------------------------------------------------------------------------
		| User Creation and Groups Settings
		|--------------------------------------------------------------------------
		|
		| Allows you to change if / how new users are added
		|
		*/

		'add_new_users'            => env('IDP_ADD_USERS',true), // Should new users be added automatically if they do not exist?
		'shibboleth_group'         => env('IDP_DEFAULT_GROUP','1'), // What group should the new users be automatically added to?

];
