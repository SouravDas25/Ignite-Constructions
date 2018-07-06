<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiteTransferTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_transfers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('site_id')->unsigned()->index('fk_site_transfer_site');
			$table->date('date');
			$table->integer('labour_id')->unsigned()->index('fk_site_transfer_labour');
			$table->integer('status_id')->unsigned()->index('fk_site_transfer_status');
            $table->timestamps();
            $table->foreign('labour_id', 'fk_site_transfer_labour')
                ->references('id')->on('labours')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('site_id', 'fk_site_transfer_site')
                ->references('id')->on('sites')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('status_id', 'fk_site_transfer_status')
                ->references('id')->on('statuses')->onUpdate('RESTRICT')->onDelete('RESTRICT');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('site_transfers');
	}

}
