<?php

class ReservarController extends BaseController {

	// Obtiene el precio de los paquete en base a los meses y espacios
	public function getPrecios(){
		$precios = Precio::where('meses', '=', Input::get('meses'))
		->where('espacios', '=', Input::get('espacios'))
		->get()->toArray();
		return Response::json($precios);
	}

	// Obtener el precio de el paquete seleccionado en base a los meses y espacios
	public function getPaquetePrecio(){
		$precios = Precio::where('meses', '=', Input::get('meses'))
		->where('espacios', '=', Input::get('espacios'))
		->where('paquete_id', '=', Input::get('paquete_id'))
		->first()->toArray();
		return Response::json($precios);
	}

	public function showCarrito(){
		$adicionales = Input::all();
		$adicionales_info = array();

		if(!empty($adicionales['adicionales'])){
			foreach($adicionales['adicionales'] as $a){
				$adicional = Adicional::find($a)->toArray();
				$adicionales_info[] = $adicional;
			}	
		}	

		$paquete = Paquete::find(Session::get('paquete_id'))->toArray();

		$espacios = Session::get('espacios');

		$meses = Session::get('meses');

		Session::put('adicionales', $adicionales_info);

		return View::make('reservar')->with(array('paquete'=>$paquete, 'espacios'=>$espacios, 'meses'=>$meses));
	}

	public function sendSolicitud(){
		$validator = Validator::make(Input::all(),
			array(
				'nombre'	=>'required',
				'correo'	=>'required|email',
				'apellidos'	=>'required',
				'titulo'	=>'required',
				'celular'	=>'required',
				'proyecto'	=>'required',
				'que_hacer'	=>'required'
				)
			);

		if($validator->fails()){
			return Redirect::back();
		}

		$solicitud = new Solicitud();
		$solicitud->paquete_id = Input::get('paquete_id');
		$solicitud->meses = Input::get('meses');
		$solicitud->espacios = Input::get('espacios');
		$solicitud->nombre = Input::get('nombre');
		$solicitud->apellidos = Input::get('apellidos');
		$solicitud->titulo = Input::get('titulo');
		$solicitud->facebook = Input::get('facebook');
		$solicitud->correo = Input::get('correo');
		$solicitud->celular = Input::get('celular');
		$solicitud->proyecto = Input::get('proyecto');
		$solicitud->que_hacer = Input::get('que_hacer');
		$solicitud->status = 1;
		$solicitud->save();

	// crear usuario
		$usuario = new Usuario();
		$rnd_string = new RandomString();
		$usuario->password = '';
		$usuario->status = 0;
		$usuario->solicitud_id = $solicitud->id;
		$usuario->save();

		$adicionales = array();
		foreach(Input::get('adicionales') as $id_adicional){
			$a = new SolicitudFeature();
			$a->solicitud_id = $solicitud->id;
			$a->feature_id = $id_adicional;
			$a->meses = Input::get('meses_'.$id_adicional);
			$a->espacios = Input::get('espacios_'.$id_adicional);
			$a->save();

			$feature = Adicional::where('id', '=', $a->feature_id)->first()->toArray();
			$feature['meses'] = Input::get('meses_'.$id_adicional);
			$feature['espacios'] = Input::get('espacios_'.$id_adicional);
			$adicionales[] = $feature;
		}

		$paquete = Paquete::find($solicitud->paquete_id);

		Mail::send( 'emails.solicitud-mail', array('datos'=>Input::all(), 'paquete'=>$paquete, 'adicionales'=>$adicionales), function($message)
		{
			$message->to('portela828@gmail.com', 'Nuwork - Nueva Solicitud')->subject('Nuwork - Nueva Solicitud');
		});

		return Redirect::to('solicitud-realizada');
	}

}
