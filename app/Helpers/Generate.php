<?php
namespace App\Helpers;

# Helpers
use Help;
# Library / package
use Auth;
use Illuminate\Http\Request;
# Models
use App\Models\Puskesmas;

class Generate{
	# Trust-mark
	public static function secretCons($request){
		if($request->puskesmas_id==''){
			$pcare = Puskesmas::find(Auth::getUser()->puskesmas_id);
		}else{
			$pcare = Puskesmas::find($request->puskesmas_id);
		}
		return $request->merge([ # Add variable to request object
			'tm_cons_id' => $pcare->cons_id,
			'tm_secret_key' => $pcare->secret_key,
			'tm_user_key' => $pcare->user_key,
			'tm_username' => $pcare->username_pcare,
			'tm_password' => $pcare->password_pcare,
			'tm_kode_aplikasi' => '095',
		]);
	}
	public static function signature($request){
		date_default_timezone_set('UTC');
		$timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
		self::secretCons($request); # Add variable credential to request object
		$secretKey = $request->tm_secret_key;
		$string = $request->tm_cons_id.'&'.$timestamp;
		$signature = hash_hmac('sha256', $string, $secretKey, true);
		$encodedSignature = base64_encode($signature);

		// $Authorization = "Basic"." ".base64_encode($username.':'.$password.':'.$kdAplikasi);

		// $userKey = $request->tm_user_key;
		// 'base_url'=>$base_url,
		// 'base_url_fktp'=>$base_url_fktp,
		// 'consId'=>$consId,
		// 'tstamps'=>$tStamp,
		// 'authorization'=>$Authorization,
		// 'signature'=>$encodedSignature,
		// 'user_key'=>$user_key,
		// 'key'=>$consId.$secretKey.$tStamp,
		return $request->merge([
			'tm_signature' => $encodedSignature,
			'tm_timestamp' => $timestamp,
			'tm_authorization' => 'Basic '.base64_encode("$request->tm_username:$request->tm_password:$request->tm_kode_aplikasi"),
			'tm_hash_key' => $request->tm_cons_id.$request->tm_secret_key.$timestamp,
		]);
	}
}