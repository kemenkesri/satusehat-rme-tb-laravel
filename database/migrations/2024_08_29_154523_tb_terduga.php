<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbTerduga extends Migration
{
    
     /**
     * Run the migrations.
     *
     * @return void
         */
    public function up()
    {
        Schema::create('tb_terduga', function (Blueprint $table) {
            $table->uuid('id')->primary();  // UUID sebagai primary key
            $table->string('no_sediaan', 255)->nullable();

            $table->string('person_id', 20)->nullable();
            $table->string('terduga_tb_id', 20)->nullable();
            $table->string('tipe_pasien_id', 20)->nullable();
            $table->string('status_dm_id');
            $table->string('status_hiv_id');
            $table->string('imunisasi_bcg_id');
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
        Schema::dropIfExists('tb_terduga');
    }
}
