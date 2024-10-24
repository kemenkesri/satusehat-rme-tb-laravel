<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Auth;

class Kabupaten extends Model
{
	protected $table = 'mst_kabupaten';
	protected $primaryKey = 'KD_KABUPATEN';
	protected $keyType = 'string';
	public $incrementing = false;
	
	public function pasien()
	{
		return $this->hasOne('App\Models\Pasien');
	}

	public function posyandu() {
		return $this->hasMany('App\Models\Posyandu','kecamatan_id','KD_KECAMATAN');
	}
}
