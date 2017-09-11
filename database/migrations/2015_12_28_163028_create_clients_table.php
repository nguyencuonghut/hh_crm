<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
        
            $table->increments('id');
            $table->string('name');
            //cuongnv
            $table->string('client_code');
            $table->string('primary_number');
            $table->string('province');
            $table->string('district');
            $table->string('ward');
            $table->string('industry');
            $table->integer('industry_id')->unsigned();
            $table->foreign('industry_id')->references('id')->on('industries');
            $table->boolean('is_key_client');
            $table->integer('scale');
            $table->integer('pig_num');
            $table->integer('broiler_chicken_num');
            $table->integer('broilder_duck_num');
            $table->integer('quail_num');
            $table->integer('aqua_num');
            $table->integer('layer_duck_num');
            $table->integer('layer_chicken_num');
            $table->integer('cow_num');
            $table->string('company_service');
            $table->boolean('is_candidate');
            $table->dateTime('signature_date');
            $table->dateTime('animal_date');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('note')->nullable();


            //~cuongnv
            $table->string('email')->unique()->nullable();
            //$table->string('primary_number')->nullable();
            //$table->string('secondary_number')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('city')->nullable();
            $table->string('company_name')->nullable();
            $table->string('vat')->nullable();
            //$table->string('industry');
            $table->string('company_type')->nullable();
            //$table->integer('user_id')->unsigned();
            //$table->foreign('user_id')->references('id')->on('users');
            //$table->integer('industry_id')->unsigned();
            //$table->foreign('industry_id')->references('id')->on('industries');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('clients');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
