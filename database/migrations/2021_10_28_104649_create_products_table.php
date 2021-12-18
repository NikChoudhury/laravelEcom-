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
            $table->integer("category_id");
            $table->string("name");
            $table->string("slug");
            $table->string("image");
            $table->string("brand")->nullable();
            $table->string("model")->nullable();
            $table->longText("short_desc")->nullable();
            $table->longText("desc")->nullable();
            $table->longText("keywords")->nullable();
            $table->longText("technical_specification")->nullable();
            $table->longText("uses")->nullable();
            $table->longText("warranty")->nullable();
            $table->string("lead_time")->nullable()
                    ->comment("When Product is Available?");
            $table->string("tax")->nullable();
            $table->string("tax_type")->nullable();
            $table->string("is_promo")->nullable()
                    ->comment("Product is Promotional or Not");
            $table->string("is_featured")->nullable()
                    ->comment("Product is Featured or Not");
            $table->string("is_discounted")->nullable();
            $table->string("is_tranding")->nullable();
            $table->integer("status")
                    ->default(0)
                    ->nullable()
                    ->comment("-1=>'deleted',0='deactive',1='active'");
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
