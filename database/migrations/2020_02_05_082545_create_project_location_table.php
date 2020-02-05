<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_location', function (Blueprint $table) {
            $table->engine = 'InnoDB';	
            $table->collation = 'utf8_unicode_ci';	
            $table->charset = 'utf8';	
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->char('kotakab_id', 4);
            $table->char('kecamatan_id', 7);
            $table->char('desa_id', 10);
            $table->integer('target')->unsigned();
            $table->integer('tim')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kotakab_id')->references('id')->on('regencies');
            $table->foreign('kecamatan_id')->references('id')->on('districts');
            $table->foreign('desa_id')->references('id')->on('villages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_location');
    }
}
