<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->double('start_bid_price',8,2);
            $table->string('status')->default('INIT');
            $table->dateTime('bid_closing_date_time', $precision = 0);
            $table->dateTime('inspection_date_time', $precision = 0);
            $table->string('category');
            $table->string('image');
            $table->string('location');
            $table->unsignedBigInteger('user_id');
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
        Schema::dropIfExists('products');
    }
}
