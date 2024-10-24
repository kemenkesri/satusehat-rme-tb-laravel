<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;

/**
 * @property string $id
 * @property string $resource
 * @property string $resource_id
 * @property string $url
 * @property string $data
 * @property string $kunjungan
 * @property string $pasien
 * @property string $faskes
 * @property string $table_name
 * @property string $table_id
 * @property string $episode_of_care_id
 * */
class SatuSehat extends Model
{
    
    protected $table = 'satusehat';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'resource',
        'resource_id',
        'url',
        'data',
        'kunjungan',
        'pasien',
        'faskes',
        'table_name',
        'table_id',
        'episode_of_care_id',
    ];

    protected $casts = [
        'data' => 'array'
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
