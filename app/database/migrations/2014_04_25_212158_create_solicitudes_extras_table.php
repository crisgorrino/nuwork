<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesExtrasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('solicitudes_features', function($table){
			$table->increments('id');
			$table->integer('solicitud_id');
			$table->integer('feature_id');
			$table->integer('meses');
			$table->integer('espacios');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('solicitudes-features');
	}

}
