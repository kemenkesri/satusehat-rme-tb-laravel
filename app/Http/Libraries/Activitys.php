<?php
namespace App\Http\Libraries;
use App\Models\ActivitySystems;
use App\Models\Users;
use Auth;

class Activitys
{
	public static function add($action_type, $users_id, $keterangan)
	{
		// return response($request);
		$user = Users::find(Auth::id());

		$addActivity = new ActivitySystems;
		$addActivity->action_type 	= $action_type;
		$addActivity->users_id 		= $users_id;
		$addActivity->keterangan 	= $keterangan;
		$addActivity->ip_address 	= $_SERVER['REMOTE_ADDR'];
		$addActivity->created_at 	= date("Y-m-d H:i:s");
		$addActivity->updated_at 	= date("Y-m-d H:i:s");
		$addActivity->save();

		if ($addActivity) {
			$return = ['status'=>'success', 'code'=>'200', 'message'=>'Aktivitas Berhasil Disimpan !!','data'=>$addActivity];
		}else{
			$return = ['status'=>'error', 'code'=>'500', 'message'=>'Aktivitas Gagal Disimpan !!','data'=>''];
		}
		return $return;
	}
}
