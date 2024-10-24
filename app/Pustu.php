<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pustu extends Model
{
	protected $table = 'pustu';
	protected $primaryKey = 'id';
	public $incrementing = false;
	
	public function users() {
		return $this->belongsTo('App\Models\Users','users_id','id');
	}
	
	public function kabupaten() {
		return $this->belongsTo('App\Models\Kabupaten','kabupaten_id','KD_KABUPATEN');
	}
	
	public function kecamatan() {
		return $this->belongsTo('App\Models\Kecamatan','kecamatan_id','KD_KECAMATAN');
	}
	
	public function desa() {
		return $this->belongsTo('App\Models\Desa','desa_id','KD_KELURAHAN');
	}
    
    public function puskesmas(){
		return $this->belongsTo('App\Models\Puskesmas','puskesmas_id');
	}

	public function posyandu()
    {
        return $this->hasMany('App\Models\Posyandu','id','pustu_id');
    }
}
