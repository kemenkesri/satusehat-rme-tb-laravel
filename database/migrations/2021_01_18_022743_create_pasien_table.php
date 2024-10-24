<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->bigIncrements('id_pasien');
            $table->string('nama_pasien');
            $table->string('alamat_pasien');
            $table->string('no_asuransi_pasien')->nullable();
            $table->string('jenis_asuransi_pasien')->nullable();
            $table->string('nik_pasien');
            $table->string('status_kewarganegaraan')->nullable();
            $table->string('paspor')->nullable();
            $table->string('kewarganegaraan')->nullable();
            $table->bigInteger('provinsi_id');
            $table->bigInteger('kabupaten_id');
            $table->bigInteger('kecamatan_id');
            $table->bigInteger('desa_id');
            $table->bigInteger('kode_pos')->nullable();
            $table->bigInteger('no_telepon');
            $table->string('jenis_no_telepon')->nullable();
            $table->string('surat_elektronik')->nullable();
            $table->string('gol_darah');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('nama_pasangan')->nullable();
            $table->string('jenis_kelamin');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->date('tgl_kematian')->nullable();
            $table->string('agama');
            $table->string('pendidikan_terakhir');
            $table->string('status_pernikahan')->nullable();
            $table->string('jenis_pekerjaan')->nullable();
            $table->string('suku')->nullable();
            $table->string('ket_identitas_pasien')->nullable();            
            $table->string('kd_pasien');            
            $table->bigInteger('puskesmas_id');            
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
        Schema::dropIfExists('pasien');
    }
}
