<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TbPermohonanLab extends Model
{
    protected $table = 'tb_permohonan_lab';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'KD_PELAYANAN',
        'KD_PASIEN',
        'KD_PUSKESMAS',
        'no_sediaan',
        'lokasi_anatomi',
        'tanggal_permohonan',
        'pengirim',
        'alasan',
        'faskes_tujuan',
        'tanggal_pengambilan',
        'tanggal_pengiriman',
        'jenis_pemeriksaan',
        'followup_ke',
        'periksa_ulang_ke',
        'contoh_uji',
        'contoh_uji_lain',
        'nomor_permohonan',
        'ID_KUNJUNGAN',
        'ID_SERVICEREQUEST_SATUSEHAT',
        'ID_SPECIMEN_SATUSEHAT'
    ];

    protected $casts = [
        'tanggal_permohonan' => 'datetime',
        'tanggal_pengambilan' => 'datetime',
        'tanggal_pengiriman' => 'datetime',
    ];


    protected static function boot()
    {
        parent::boot();

        // Generate UUID sebelum model disimpan
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
