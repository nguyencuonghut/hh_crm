<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
        
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('code')->unique();
            $table->string('password', 60);
            $table->string('address')->nullable();
            $table->string('work_number')->nullable();
            $table->string('personal_number');
            $table->string('image_path')->nullable();
            $table->string('opened_agents_1')->default(0);
            $table->string('opened_agents_2')->default(0);
            $table->string('opened_agents_3')->default(0);
            $table->string('opened_agents_4')->default(0);
            $table->string('opened_agents_5')->default(0);
            $table->string('opened_agents_6')->default(0);
            $table->string('opened_agents_7')->default(0);
            $table->string('opened_agents_8')->default(0);
            $table->string('opened_agents_9')->default(0);
            $table->string('opened_agents_10')->default(0);
            $table->string('opened_agents_11')->default(0);
            $table->string('opened_agents_12')->default(0);

            $table->string('candidate_agents_1')->default(0);
            $table->string('candidate_agents_2')->default(0);
            $table->string('candidate_agents_3')->default(0);
            $table->string('candidate_agents_4')->default(0);
            $table->string('candidate_agents_5')->default(0);
            $table->string('candidate_agents_6')->default(0);
            $table->string('candidate_agents_7')->default(0);
            $table->string('candidate_agents_8')->default(0);
            $table->string('candidate_agents_9')->default(0);
            $table->string('candidate_agents_10')->default(0);
            $table->string('candidate_agents_11')->default(0);
            $table->string('candidate_agents_12')->default(0);

            $table->string('opened_farms_1')->default(0);
            $table->string('opened_farms_2')->default(0);
            $table->string('opened_farms_3')->default(0);
            $table->string('opened_farms_4')->default(0);
            $table->string('opened_farms_5')->default(0);
            $table->string('opened_farms_6')->default(0);
            $table->string('opened_farms_7')->default(0);
            $table->string('opened_farms_8')->default(0);
            $table->string('opened_farms_9')->default(0);
            $table->string('opened_farms_10')->default(0);
            $table->string('opened_farms_11')->default(0);
            $table->string('opened_farms_12')->default(0);

            $table->string('candidate_farms_1')->default(0);
            $table->string('candidate_farms_2')->default(0);
            $table->string('candidate_farms_3')->default(0);
            $table->string('candidate_farms_4')->default(0);
            $table->string('candidate_farms_5')->default(0);
            $table->string('candidate_farms_6')->default(0);
            $table->string('candidate_farms_7')->default(0);
            $table->string('candidate_farms_8')->default(0);
            $table->string('candidate_farms_9')->default(0);
            $table->string('candidate_farms_10')->default(0);
            $table->string('candidate_farms_11')->default(0);
            $table->string('candidate_farms_12')->default(0);

            $table->integer('gs_id')->unsigned()->default(0);
            $table->foreign('gs_id')->references('id')->on('users');
            $table->integer('tv_id')->unsigned()->default(0);
            $table->foreign('tv_id')->references('id')->on('users');
            $table->integer('gd_vung_id')->unsigned()->default(1);
            $table->foreign('gd_vung_id')->references('id')->on('users');
            $table->integer('pgd_id')->unsigned()->default(1);
            $table->foreign('pgd_id')->references('id')->on('users');
            $table->integer('gd_id')->unsigned()->default(1);
            $table->foreign('gd_id')->references('id')->on('users');
            $table->rememberToken();
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
        Schema::drop('users');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
