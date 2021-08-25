<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepositToBidssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bids', function (Blueprint $table) {
            $table->double('deposit',8,2)->nullable();
            $table->string('deposit_status',8,2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bids', function (Blueprint $table) {
            $table->dropColumn('deposit');
            $table->dropColumn('deposit_status');
        });
    }
}
