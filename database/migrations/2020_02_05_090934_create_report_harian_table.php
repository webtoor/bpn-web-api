<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportHarianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_harian', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->integer('project_location_id')->unsigned();
            $table->integer('terukur');
            $table->integer('tergambar');
            $table->integer('kkp');
            $table->integer('pengukuran');
            $table->integer('pemetaan');
            $table->integer('pbt');
            $table->integer('su');
            $table->integer('pengumuman');
            $table->integer('pengesahan');
            $table->string('keterangan');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_location_id')->references('id')->on('project_location')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_harian');
    }
}
