<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome($espacios, $meses, $tipo)
	{
		return View::make('hello');
	}

	public function saveSelection(){

		// Save in session the user selections
		Session::put('espacios', Input::get('espacios'));

		Session::put('meses', Input::get('meses'));

		Session::put('paquete_id', Input::get('paquete_id'));

		// Redirect to the page of [adicionales]
		return Redirect::to('adicionales');
	}

}
