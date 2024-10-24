<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbHasilLabTable extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_hasil_lab', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('KD_PELAYANAN', 20)->nullable();
            $table->string('KD_PASIEN', 20)->nullable();
            $table->string('KD_PUSKESMAS', 20)->nullable();
            $table->dateTime('tgl_contoh_uji')->nullable();
            $table->text('kondisi_contoh_uji')->nullable();
            $table->dateTime('tanggal_daftar')->nullable();
            $table->text('pemeriksa')->nullable()->comment('dokter pemeriksa');
            $table->text('contoh_uji')->nullable();
            $table->string('contoh_uji_lain', 45)->nullable();
            $table->dateTime('tanggal_hasil')->nullable();
            $table->string('no_reg_hasil', 45)->nullable();
            $table->text('hasil')->nullable();
            $table->text('catatan')->nullable();
            $table->text('tcm_xdr')->nullable();
            $table->string('xdr_mtb', 45)->nullable();
            $table->string('xdr_h', 45)->nullable();
            $table->string('xdr_ht', 45)->nullable();
            $table->string('xdr_fq', 45)->nullable();
            $table->string('xdr_fqt', 45)->nullable();
            $table->string('xdr_amk', 45)->nullable();
            $table->string('xdr_km', 45)->nullable();
            $table->string('xdr_cm', 45)->nullable();
            $table->string('xdr_eto', 45)->nullable();
            $table->string('lpa_lini1', 45)->nullable();
            $table->string('lini1_mtb', 45)->nullable();
            $table->string('lini1_inh', 45)->nullable();
            $table->string('lini1_inhh', 45)->nullable();
            $table->string('lini1_rif', 45)->nullable();
            $table->string('lini1_eto', 45)->nullable();
            $table->string('lini1_pto', 45)->nullable();
            $table->string('lpa_lini2', 45)->nullable();
            $table->string('lini2_mtb', 45)->nullable();
            $table->string('lini2_lfx', 45)->nullable();
            $table->string('lini2_mfx', 45)->nullable();
            $table->string('lini2_mfx_dt', 45)->nullable();
            $table->string('lini2_amk', 45)->nullable();
            $table->string('lini2_km', 45)->nullable();
            $table->string('lini2_cm', 45)->nullable();
            $table->string('biakan_metode', 45)->nullable();
            $table->string('kepekaan_ht', 45)->nullable();
            $table->string('kepekaan_h', 45)->nullable();
            $table->string('kepekaan_km', 45)->nullable();
            $table->string('kepekaan_cm', 45)->nullable();
            $table->string('kepekaan_lfx', 45)->nullable();
            $table->string('kepekaan_mfxt', 45)->nullable();
            $table->string('kepekaan_mfx', 45)->nullable();
            $table->string('kepekaan_amk', 45)->nullable();
            $table->string('kepekaan_eto', 45)->nullable();
            $table->string('kepekaan_lzd', 45)->nullable();
            $table->string('kepekaan_dlm', 45)->nullable();
            $table->string('kepekaan_cfz', 45)->nullable();
            $table->string('kepekaan_bdq', 45)->nullable();
            $table->string('kepekaan_ofl', 45)->nullable();
            $table->string('kepekaan_s', 45)->nullable();
            $table->string('kepekaan_e', 45)->nullable();
            $table->string('kepekaan_z', 45)->nullable();
            $table->unsignedInteger('ID_KUNJUNGAN')->nullable();
            $table->string('bdmax_mtb', 45)->nullable();
            $table->string('bdmax_rif', 45)->nullable();
            $table->string('bdmax_inh', 45)->nullable();
            $table->string('bdmax_katg', 45)->nullable();
            $table->string('bdmax_apr', 45)->nullable();
            $table->string('pcr_mtb', 45)->nullable();
            $table->string('pcr_rif', 45)->nullable();
            $table->string('pcr_inh', 45)->nullable();
            $table->string('pcr_ntm', 45)->nullable();
            $table->string('pcr_katg', 45)->nullable();
            $table->string('pcr_apr', 45)->nullable();
            $table->text('satusehat_response')->nullable();
            $table->text('jenis_pemeriksaan')->nullable();
            $table->text('penerima')->nullable();
            $table->text('ID_DIAGNOSTICREPORT_SATUSEHAT')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_hasil_lab');
    }
}
