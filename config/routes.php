<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */
$routes = array(
	'/home' => 'home#home',
	'/test' => 'test#index',
	'/login' => 'login#login',
	'/logout' => 'logout#logout',
	'/register' => 'register#register',
	'/listFilms' => 'listFilms#listFilms',
	'/addFilm' => 'addFilm#addFilm',
    '/deleteFilm' => 'deleteFilm#deleteFilm',
	'/updateFilm' => 'updateFilm#updateFilm',
	'/listCategories' => 'listCategory#listCategory',
	'/createCategories' => 'createCategory#createCategory',
	'/updateCategories' => 'updateCategory#updateCategory',
	'/deleteCategories' => 'deleteCategory#deleteCategory',
	'/edit_profile' => 'editProfile#editProfile'
);
