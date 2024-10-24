<?php

namespace App\Models;

use App\Concern\WorkingWithTBModels;
use App\Contracts\TBInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

/**
 * @property string $id
 * @property string $KD_PELAYANAN
 * @property string $KD_PASIEN
 * @property string $KD_PUSKESMAS
 * @property string $no_sediaan
 * @property string $lokasi_anatomi
 * @property Date $tanggal_permohonan
 * @property string $pengirim
 * @property string $alasan
 * @property string $faskes_tujuan
 * @property Date $tanggal_pengambilan
 * @property Date $tanggal_pengiriman
 * @property string $jenis_pemeriksaan
 * @property string $followup_ke
 * @property string $periksa_ulang_ke
 * @property string $contoh_uji
 * @property string $contoh_uji_lain
 * @property string $nomor_permohonan
 * @property string $satusehat_response
 * @property string $ID_KUNJUNGAN
 * @property string $ID_SERVICEREQUEST_SATUSEHAT
 * @property string $ID_SPECIMEN_SATUSEHAT
 * */
class TbPermohonanLab extends Model implements TBInterface
{
    
    use WorkingWithTBModels;

    protected $table = 'tb_permohonan_lab';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'KD_PELAYANAN',
        'KD_PASIEN',
        'KD_PUSKESMAS',
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
        'satusehat_response',
        'ID_KUNJUNGAN',
        'ID_SERVICEREQUEST_SATUSEHAT',
        'ID_SPECIMEN_SATUSEHAT'
    ];

    protected $casts = [
        'satusehat_response' => 'array',
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
