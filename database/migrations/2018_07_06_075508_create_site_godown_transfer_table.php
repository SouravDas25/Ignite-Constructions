<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteGodownTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_godown_transfer', function (Blueprint $table) {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_godown_transfer');
    }
}
