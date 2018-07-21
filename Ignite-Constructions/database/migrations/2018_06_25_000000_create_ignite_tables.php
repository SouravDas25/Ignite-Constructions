<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIgniteTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 250);
            $table->string('contact_no', 10)->unique('contact_no');
            $table->string('email')->unique('email');
            $table->timestamps();
        });

        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('details');

            $table->integer('unit_id')->unsigned()->index('fk_goods_units')->default('1');
            $table->timestamps();
            $table->foreign('unit_id', 'fk_goods_units')
                ->references('id')->on('units')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('godowns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->geometry('location');
            $table->string('address');
            $table->timestamps();
        });

        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id')->unsigned()->index('fk_seller_purchase');
            $table->date('date');
            //$table->integer('quantity');
            $table->decimal('purchase_due', 50, 2);
            $table->timestamps();
            $table->foreign('seller_id', 'fk_seller_purchase')
                ->references('id')->on('sellers')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('godown_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('godown_id')->unsigned()->index('fk_godown_transfer_godown');
            $table->integer('goods_id')->unsigned()->index('fk_seller_goods');
            $table->integer('purchase_id')->unsigned()->index('fk_purchase_godown');
            $table->integer('quantity');
            $table->decimal('cost', 50, 2);
            $table->timestamps();
            $table->foreign('godown_id', 'fk_godown_transfer_godown')
                ->references('id')->on('godowns')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('goods_id', 'fk_godown_transfers_goods')
                ->references('id')->on('goods')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('purchase_id', 'fk_purchase_godown')
                ->references('id')->on('purchases')->onUpdate('RESTRICT')->onDelete('RESTRICT');

        });

        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->geometry('location');
            $table->string('address');
            $table->timestamps();
        });

        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('details');
            $table->timestamps();
        });

        Schema::create('labours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique('name');
            $table->geometry('location');
            $table->string('password');
            $table->integer('activeTransfer_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::create('site_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id')->unsigned()->index('fk_site_transfer_site');
            $table->date('date');
            $table->integer('radius')->default(50);
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

        Schema::create('site_godown_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('godown_transfer_id')->unsigned()->index('fk_site_godown_transfer_godown_transfer');
            $table->integer('site_transfer_id')->unsigned()->index('fk_site_godown_transfer_site_transfer');
            $table->integer('quantity');
            $table->timestamps();
            $table->foreign('godown_transfer_id', 'fk_site_godown_transfer_godown_transfer')
                ->references('id')->on('godown_transfers')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('site_transfer_id', 'fk_site_godown_transfer_site_transfer')
                ->references('id')->on('site_transfers')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });

        Schema::create('site_transfer_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_transfer_id')->unsigned()->index('fk_site_transfer_details_site_transfer');
            $table->dateTime('datetime');
            $table->string('title');
            $table->text('details')->nullable();
            $table->tinyInteger('journey_status')->nullable();
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
        Schema::dropIfExists('site_godown_transfers');
        Schema::dropIfExists('site_transfer_details');
        Schema::dropIfExists('site_transfers');
        Schema::dropIfExists('labours');
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('godown_transfers');
        Schema::dropIfExists('sites');
        Schema::dropIfExists('godowns');
        Schema::dropIfExists('purchases');
        Schema::dropIfExists('goods');
        Schema::dropIfExists('sellers');
        Schema::dropIfExists('units');
    }

}
