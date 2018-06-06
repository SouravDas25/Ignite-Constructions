<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSitetransferdetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sitetransferdetails', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sitetransfer_id');
			$table->dateTime('time_date');
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
		Schema::drop('sitetransferdetails');
	}

}
