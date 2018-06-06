<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSitetransfersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sitetransfers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('site_id')->nullable();
			$table->date('date')->nullable();
			$table->integer('godowntransfer_id')->nullable();
			$table->integer('quantity')->nullable();
			$table->integer('labour_id')->nullable();
			$table->integer('status_id')->nullable();
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
		Schema::drop('sitetransfers');
	}

}
