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

}
