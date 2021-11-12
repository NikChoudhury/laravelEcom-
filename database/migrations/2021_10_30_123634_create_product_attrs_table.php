<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attrs', function (Blueprint $table) {
            $table->id();
            $table->integer("product_id")->comment('From Products Table');
            $table->string("sku")->comment('Stock Keeping Unit')->nullable();
            $table->string("attr_image")->nullable();
            $table->float("mrp")->comment('Maximum retail price');
            $table->float("price");
            $table->integer('qty')->comment('Quantity');
            $table->integer('size_id')->comment('From Size Table');
            $table->integer('color_id')->comment('From Color Table');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_attrs');
    }
}
