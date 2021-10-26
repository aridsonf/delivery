<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelRequestsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests_data', function (Blueprint $table) {
            $table->id();
            $table->biginteger('delivery_id')->unsigned();
            $table->foreign('delivery_id')->references('id')->on('delivery_requests')->onDelete('cascade')->onUpdate('cascade');
            $table->biginteger('product_id')->nullable()->unsigned();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('product_quant');
            $table->integer('product_quant_delivered');
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
        Schema::dropIfExists('requests_data');
    }
}
