<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivitySystems extends Model
{
    protected $table = 'aktifitas_system';
    protected $primaryKey = 'id';
    protected $fillable = ['action_type','users_id','keterangan','id_address','created_at','update_at'];

    public $timestamps = true;

    public function creator(){
      return $this->belongsTo('App\Models\Users','creator_id');
    }
}
