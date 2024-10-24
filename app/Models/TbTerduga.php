<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;
use App\Concern\WorkingWithTBModels;
use App\Contracts\TBInterface;

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
class TbTerduga extends Model implements TBInterface
{
        use WorkingWithTBModels;

    
    protected $table = 'tb_terduga';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'no_sediaan',
        'person_id',
        'terduga_tb_id',
        'tipe_pasien_id',
        'status_dm_id',
        'status_hiv_id',
        'imunisasi_bcg_id'

    ];

   public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'person_id', 'id_pasien');
    }

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
