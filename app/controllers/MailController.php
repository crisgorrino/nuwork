<?php

class MailController extends BaseController {

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

	public function sendMessage()
	{
		$validation = Validator::make(
			Input::all(),
			array(
				'nombre'	=> 'required|max:30',
				'email'		=> 'required|email|max:40',
				'telefono'	=> 'required|digits_between:5,10',
				'ciudad'	=> 'required|max:30',
				'medio'		=> 'required|max:50',
				'mensaje'	=> 'required|max:250'
				), 
			array(
				'required'    	=> 'El :attribute es requerido.',
				'max'    		=> 'El :attribute no debe tener más de :max caractéres.',
				'digits_between'=> 'El :attribute debe contener entre :min y :max dígitos.',
				'email' 		=> 'El :attribute no es un e-mail valido'
				)
		);

		if($validation->fails()){
			return Redirect::to('/')->withErrors($validation->errors());
		}else{
			Mail::send('emails.contact-message-mail', array('datos'=>Input::all()), function($message){
				$message->to('portela828@gmail.com', 'John Smith')->subject('Nuevo Mensaje de Contacto');
			});
		}
		return Redirect::to('/');
	}

}
