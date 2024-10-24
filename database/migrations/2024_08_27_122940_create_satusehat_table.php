<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSatusehatTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('satusehat', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('resource');
            $table->string('resource_id');
            $table->string('url');
            $table->text('data');
            $table->string('kunjungan');
            $table->string('pasien');
            $table->string('faskes');
            $table->string('table_name');
            $table->string('table_id');
            $table->string('episode_of_care_id');
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
        Schema::dropIfExists('satusehat');
    }
}
