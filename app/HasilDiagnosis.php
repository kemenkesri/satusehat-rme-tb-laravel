<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HasilDiagnosis extends Model
{
    //

     // Nama tabel yang terkait dengan model
    protected $table = 'tb_kasus';

    // Menonaktifkan timestamps jika tidak ada kolom created_at dan updated_at
    public $timestamps = false;

    // Daftar kolom yang dapat diisi melalui mass assignment
    protected $fillable = [
        'id',
        'KD_PELAYANAN',
        'KD_PASIEN',
        'KD_PUSKESMAS',
        'tanggal_hasil',
        'thorax_tanggal',
        'thorax_hasil',
        'thorax_kesan',
        'lokasi_anatomi',
        'hasil_diagnosis',
        'tindak_lanjut',
        'tempat_pengobatan',
        'dirujuk_ke',
        'ID_KUNJUNGAN',
        'tipe_diagnosis',
    ];

    // Jika ingin menggunakan UUID sebagai primary key
    protected $keyType = 'string';
    public $incrementing = false;
}
