<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("email")->nullable();
            $table->string("mobile");
            $table->string("password");
            $table->string("image")->nullable();
            $table->longtext("address")->nullable();
            $table->string("city")->nullable();
            $table->string("state")->nullable();
            $table->string("pin")->nullable();
            $table->string("country")->nullable();
            $table->string("company")->nullable();
            $table->string("gstin")->nullable();
            $table->string("token")->nullable();
            $table->enum('is_email_verified',[0,1])
                    ->default(0)
                    ->nullable()
                    ->comment("0=>'Not Verified',1='verified'");
            $table->enum('is_mobile_verified',[0,1])
                    ->default(0)
                    ->nullable()
                    ->comment("0=>'Not Verified',1='verified'");
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
        Schema::dropIfExists('customers');
    }
}
