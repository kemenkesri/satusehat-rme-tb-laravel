<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbKasusTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kasus', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('KD_PELAYANAN', 20)->nullable();
            $table->string('KD_PASIEN', 20)->nullable();
            $table->string('KD_PUSKESMAS', 20)->nullable();
            $table->dateTime('tanggal_hasil')->nullable();
            $table->dateTime('thorax_tanggal')->nullable();
            $table->string('thorax_hasil', 45)->nullable();
            $table->string('thorax_kesan', 45)->nullable();
            $table->string('lokasi_anatomi', 45)->nullable();
            $table->string('hasil_diagnosis', 45)->nullable();
            $table->string('tindak_lanjut', 45)->nullable();
            $table->string('tempat_pengobatan', 45)->nullable();
            $table->string('dirujuk_ke', 45)->nullable();
            $table->integer('ID_KUNJUNGAN')->nullable();
            $table->string('tipe_diagnosis', 20)->nullable();
            $table->text('satusehat_response')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_kasus');
    }
}
