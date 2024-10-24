<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Auth;

class Provinsi extends Model{
	protected $table = 'mst_provinsi';
	protected $primaryKey = 'KD_PROVINSI';
	public $keyType ='string'; 

	public function pasien(){
		return $this->hasOne('App\Models\Pasien');
	}
}
