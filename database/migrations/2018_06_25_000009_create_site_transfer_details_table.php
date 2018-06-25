<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiteTransferDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_transfer_details', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('site_transfer_id')->unsigned()->index('fk_site_transfer_details_site_transfer');
			$table->dateTime('onset_datetime');
			$table->integer('quantity');
			$table->timestamps();
            $table->foreign('site_transfer_id', 'fk_site_transfer_details_site_transfer')
                ->references('id')->on('site_transfers')->onUpdate('RESTRICT')->onDelete('RESTRICT');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('site_transfer_details');
	}

}
