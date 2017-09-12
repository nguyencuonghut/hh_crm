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
            $table->integer('client_type_id')->unsigned();
            $table->foreign('client_type_id')->references('id')->on('client_types');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups');
            $table->integer('scale');
            $table->integer('pig_num');
            $table->integer('broiler_chicken_num');
            $table->integer('broilder_duck_num');
            $table->integer('quail_num');
            $table->integer('aqua_num');
            $table->integer('layer_duck_num');
            $table->integer('layer_chicken_num');
            $table->integer('cow_num');
            $table->integer('product_category_id')->unsigned();
            $table->foreign('product_category_id')->references('id')->on('product_categories');
            $table->dateTime('signature_date')->nullable();
            $table->dateTime('animal_date')->nullable();
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
            $table->string('industry')->nullable();
            $table->string('company_type')->nullable();
            //$table->integer('user_id')->unsigned();
            //$table->foreign('user_id')->references('id')->on('users');
            $table->integer('industry_id')->unsigned()->nullable();
            $table->foreign('industry_id')->references('id')->on('industries')->nullable();
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
