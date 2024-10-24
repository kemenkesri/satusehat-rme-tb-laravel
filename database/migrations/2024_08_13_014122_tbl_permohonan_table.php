<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblPermohonanTable extends Migration
{


        /**
     * Run the migrations.
     *
     * @return void
         */
    public function up()
    {
        Schema::create('tb_permohonan_lab', function (Blueprint $table) {
            $table->uuid('id')->primary();  // UUID sebagai primary key
            $table->string('KD_PELAYANAN', 20)->nullable();
            $table->string('KD_PASIEN', 20)->nullable();
            $table->string('KD_PUSKESMAS', 20)->nullable();
            $table->string('no_sediaan',255)->nullable();
            $table->string('lokasi_anatomi');
            $table->date('tanggal_permohonan');
            $table->string('pengirim');
            $table->text('alasan')->nullable();
            $table->string('faskes_tujuan')->nullable();
            $table->date('tanggal_pengambilan');
            $table->date('tanggal_pengiriman');
            $table->string('jenis_pemeriksaan');
            $table->integer('followup_ke')->nullable();
            $table->integer('periksa_ulang_ke')->nullable();
            $table->string('contoh_uji');
            $table->string('contoh_uji_lain')->nullable();
            $table->string('nomor_permohonan')->nullable();
            $table->text('satusehat_response')->nullable();
            $table->string('ID_KUNJUNGAN')->nullable();
            $table->string('ID_SERVICEREQUEST_SATUSEHAT')->nullable();
            $table->string('ID_SPECIMEN_SATUSEHAT')->nullable();
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
        Schema::dropIfExists('tb_permohonan_lab');
    }
}
