<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePurchaseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchases', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('seller_id')->unsigned()->index('fk_seller_purchase');
			$table->integer('goods_id')->unsigned()->index('fk_seller_goods');
			$table->date('date');
			//$table->integer('quantity');
			$table->decimal('cost', 50, 2);
			$table->decimal('purchase_due', 50, 2);
			$table->timestamps();
            $table->foreign('goods_id', 'fk_seller_goods')
                ->references('id')->on('goods')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('seller_id', 'fk_seller_purchase')
                ->references('id')->on('sellers')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('purchases');
	}

}
