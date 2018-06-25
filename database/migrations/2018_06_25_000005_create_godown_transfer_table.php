<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGodownTransferTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('godown_transfers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('godown_id')->unsigned()->index('fk_godown_transfer_godown');
            $table->integer('purchase_id')->unsigned()->index('fk_purchase_godown');
            $table->date('date');
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('godown_id', 'fk_godown_transfer_godown')
                ->references('id')->on('godowns')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('purchase_id', 'fk_purchase_godown')
                ->references('id')->on('purchases')->onUpdate('RESTRICT')->onDelete('RESTRICT');

        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('godown_transfers');
	}

}
