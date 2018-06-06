<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGodowntransfersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('godowntransfers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('godown_id');
			$table->integer('purchase_id');
			$table->date('date');
			$table->integer('quantity');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('godowntransfers');
	}

}
