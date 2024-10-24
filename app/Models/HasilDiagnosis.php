<?php

namespace App\Models;

use App\Concern\WorkingWithTBModels;
use App\Contracts\TBInterface;
use Illuminate\Database\Eloquent\Model;

class HasilDiagnosis extends Model implements TBInterface
{
    
    use WorkingWithTBModels;

    protected $table = 'tb_kasus';

    public $timestamps = false;

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

    protected $keyType = 'string';
    public $incrementing = false;
}
