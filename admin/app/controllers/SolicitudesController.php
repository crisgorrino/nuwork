<?php

class SolicitudesController extends BaseController {
	
	// Obtener todas las solicitudes registradas
	public function getSolicitudes(){
		
		$s = array();
		$solicitudes = Solicitud::orderBy('id', 'DESC')->get()->toArray();
		foreach($solicitudes as $solicitud){
			$paquete = Paquete::find($solicitud['paquete_id'])->toArray();
			$solicitud_status = SolicitudStatus::find($solicitud['status'])->toArray();

			$solicitud['paquete'] = $paquete['nombre'];
			$solicitud['status_id'] = $solicitud['status'];
			$solicitud['status'] = $solicitud_status['descripcion'];

			$s[] = $solicitud;
		}
		
		$result = array();
		
		if(Session::get('solicitudes_status_id')){
			foreach ($s as $solicitud) {
				if($solicitud['status_id'] == Session::get('solicitudes_status_id')){
					$result[] = $solicitud;
				}
			}
		}else{
			 $result = $s;
		}

		if(Session::get('solicitudes_paquete_id') && Session::get('solicitudes_paquete_id') !='0'){
			$tmp = array();
			foreach($result as $solicitud){
				if($solicitud['paquete_id'] == Session::get('solicitudes_paquete_id')){
					$tmp[] = $solicitud;
				}
			}
			$result  = $tmp;
		}

		if(Session::get('solicitudes_nombre') && Session::get('solicitudes_nombre') != ''){
			$tmp = array();
			foreach($result as $solicitud){
				if(strtolower($solicitud['nombre']) == strtolower(Session::get('solicitudes_nombre')) ){
					$tmp[] = $solicitud;
				}
			}
			$result  = $tmp;
		}

		if(Session::get('solicitudes_apellidos') && Session::get('solicitudes_apellidos') != ''){
			$tmp = array();
			foreach($result as $solicitud){
				if(strtolower($solicitud['apellidos']) == strtolower(Session::get('solicitudes_apellidos')) ){
					$tmp[] = $solicitud;
				}
			}
			$result  = $tmp;
		}

				//filtrar por fecha
		if(Session::get('solicitudes_desde') != '' && Session::get('solicitudes_hasta') != ''){
			$tmp = array();
			foreach ($result as $solicitud) {
				$created_date = strtotime($solicitud['created_at']);
				if( $created_date >= strtotime(Session::get('solicitudes_desde')) &&
				 	$created_date <= strtotime(Session::get('solicitudes_hasta')) ){
					$tmp[] = $solicitud;
				}
			}
			$result  = !empty($tmp) ? $result : $tmp;
		}else{
			if(Session::get('solicitudes_desde') != ''){
				$tmp = array();
				foreach ($result as $solicitud) {
					$created_date = strtotime($solicitud['created_at']);
					if( $created_date >= strtotime(Session::get('solicitudes_desde'))  ){
						$tmp[] = $solicitud;
					}
				}
				$result  = $tmp;
			}

			if(Session::get('solicitudes_hasta') != ''){
				$tmp = array();
				foreach ($result as $solicitud) {
					$created_date = strtotime($solicitud['created_at']);
					if( $created_date <= strtotime(Session::get('solicitudes_hasta'))  ){
						$tmp[] = $solicitud;
					}
				}
				$result  = $tmp;
			}
		}

	
		if(empty($result)){
			$result = $s;
		}

		return Response::json($result);
	}

	public function getEditSolicitud($id){
		$solicitud = Solicitud::find($id)->toArray();

		$paquete = Paquete::find($solicitud['paquete_id'])->toArray();

		// Obtener los servicios adicionales
		$ad = SolicitudAdicionales::where('solicitud_id', '=', $solicitud['id'])->get()->toArray();

		$adicionales = array();
		foreach($ad as $adicional){
			$a = Adicional::find($adicional['feature_id'])->toArray();	
			$adicional['nombre'] = $a['nombre'];
			$adicionales[] = $adicional;
		}

		$solicitud['paquete'] = $paquete['nombre'];

		return View::make('editar_solicitud')->with(array('solicitud'=>$solicitud, 'adicionales'=>$adicionales));
	}

	public function getSolicitudesEstatus(){
		$solicitud_estatus = SolicitudStatus::all();
		return Response::json($solicitud_estatus);
	}

	public function putSolicitudEstatus(){
		try{
			$solicitud = Solicitud::find(Input::get('solicitud_id'));
			$solicitud->status = Input::get('status');
			$solicitud->save();

			if(Input::get('status') == 2){
				$usuario = Usuario::where('solicitud_id', '=', $solicitud->id)->first();
				$rnd_string = new RandomString();
				$password = $rnd_string->generateRandomString(5);
				$usuario->password = Hash::make($password);
				Mail::send('emails.sendClientPass', array('solicitud'=>$solicitud, 'usuario'=>$usuario, 'password'=>$password), 
					function($message) use($solicitud){
						$message->to($solicitud->correo, $solicitud->nombre)->subject('¡Bienvenido a Nuwork!');
					});
				$usuario->status = 1;
				$usuario->save();
			}
			return Response::make('Solicitud actualizada');
		}catch(Exeption $e){
			return Response::json($e);
		}	
	}
}
