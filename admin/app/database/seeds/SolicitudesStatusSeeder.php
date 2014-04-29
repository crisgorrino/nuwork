<?php

class SolicitudesStatusSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('solicitud_estatus')->delete();

		$solicitud_status1 = new SolicitudStatus();
		$solicitud_status1->descripcion = 'Nueva';
		$solicitud_status1->save();

		$solicitud_status2 = new SolicitudStatus();
		$solicitud_status2->descripcion = 'Aceptada';
		$solicitud_status2->save();

		$solicitud_status3 = new SolicitudStatus();
		$solicitud_status3->descripcion = 'Rechazada';
		$solicitud_status3->save();

		$solicitud_status4 = new SolicitudStatus();
		$solicitud_status4->descripcion = 'Cancelada';
		$solicitud_status4->save();
	}

}
