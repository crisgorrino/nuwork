<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('solicitudes', function($table){
			$table->increments('id');
			$table->integer('paquete_id');
			$table->integer('meses');
			$table->integer('espacios');
			$table->string('nombre');
			$table->string('apellidos');
			$table->string('titulo');
			$table->string('facebook');
			$table->string('correo');
			$table->string('celular');
			$table->string('proyecto');
			$table->text('que_hacer');
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
		Schema::drop('solicitudes');
	}

}
