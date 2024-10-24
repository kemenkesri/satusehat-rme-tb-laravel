<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Auth;

class Kecamatan extends Model
{
	protected $table = 'mst_kecamatan';
	protected $primaryKey = 'KD_KECAMATAN';
	public $incrementing = false;
	
	public function pasien()
	{
		return $this->hasOne('App\Models\Pasien');
	}

	public function posyandu() {
		return $this->hasMany('App\Models\Posyandu','kabupaten_id','KD_KABUPATEN');
	}

	public function kelurahan() {
		return $this->hasMany('App\Models\Kelurahan','KD_KECAMATAN','KD_KECAMATAN');
	}
}
