<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdenesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ordenes', function($table){
			$table->increments('id');
			$table->integer('usuario_id');
			$table->string('TOKEN');
			$table->string('CHECKOUTSTATUS');
			$table->date('TIMESTAMP');
			$table->string('CORRELATIONID');
			$table->string('ACK');
			$table->string('EMAIL');
			$table->string('PAYERID');
			$table->string('PAYERSTATUS');
			$table->string('FIRSTNAME');
			$table->string('LASTNAME');
			$table->string('COUNTRYCODE');
			$table->string('SHIPTONAME');
			$table->string('SHIPTOSTREET');
			$table->string('SHIPTOCITY');
			$table->string('SHIPTOSTATE');
			$table->string('SHIPTOZIP');
			$table->string('SHIPTOCOUNTRYCODE');
			$table->string('SHIPTOCOUNTRYNAME');
			$table->string('ADDRESSSTATUS');
			$table->string('CURRENCYCODE');
			$table->float('AMT');
			$table->string('PAYMENTREQUEST_0_TRANSACTIONID');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
