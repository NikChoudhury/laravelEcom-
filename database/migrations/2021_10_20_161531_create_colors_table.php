<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string("color_name");
            $table->string("color_code")->nullable();
            $table->string("color_details")->nullable();
            $table->enum('status',[-1,0,1])
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
        Schema::dropIfExists('colors');
    }
}
