<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Auth;

class Desa extends Model
{
	protected $table = 'mst_kelurahan';
	protected $primaryKey = 'KD_KELURAHAN';
	public $incrementing = false;
	
	public function pasien()
	{
		return $this->hasOne('App\Models\Pasien');
	}

	public function posyandu() {
		return $this->hasMany('App\Models\Posyandu','desa_id','KD_KELURAHAN');
	}

	public function kecamatan() {
		return $this->belongsTo('App\Models\Kecamatan','KD_KECAMATAN','KD_KECAMATAN');
	}

	public function sasaran() {
		return $this->belongsTo('App\Models\Posyandu\Sasaran','KD_KELURAHAN','desa_id');
	}
}
