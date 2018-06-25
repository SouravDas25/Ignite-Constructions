<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSellerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sellers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 250);
			$table->string('contact_no', 10)->unique('contact_no');
			$table->string('email')->unique('email');
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
		Schema::drop('sellers');
	}

}
