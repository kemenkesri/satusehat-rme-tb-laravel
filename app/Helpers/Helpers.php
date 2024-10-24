<?php
namespace App\Helpers;

use App\Models\Pasien;
use App\Models\Posyandu\Antropometri;
use App\Models\Posyandu\Screening;
use App\Models\Posyandu\View\PasienCurrentData;
use Help, Validator, DateTime, Auth, DB;

class Helpers {
	public static function timezoneSet(){
		date_default_timezone_set('Asia/Jakarta');
	}

	public static function resHttp($data=[]){
		$keyData = ['message','code','response'];
		$arr = [];
		foreach($keyData as $key => $val){
			$arr[$val] = isset($data[$val]) ? $data[$val] : ( # Cek key, apakah sudah di set
				$val=='code' ? 500 : (
					$val=='message' ? '-' : []
				)
			);
		}
		$code = $arr['code'];
		$msg = $arr['message'];

		$metadata = [
			'code'    => $arr['code'],
			'message' => $arr['message'],
		];
		$payload['metadata'] = $metadata;
		$payload['response'] = $arr['response'];
		return response()->json($payload,$code);
	}

	# Start should validate password
	public static function shouldValidatePassword($id) {
		// Jika nilai 'id' tidak null, maka password tidak wajib
		return is_null($id);
	}

	# Modify logging payload for exception handler
	public static function getMessage($e){
		$conn = $e instanceof \PDOException; # Instance database connection(boolean)
		$sqlState = self::cekSqlState($e,[
			'42000', # Syntax error
			'42S02',
			'42S22',
			'1364'
		]);
		$payload = [
			'title' => 'System error',
			'message' => 'Kami tidak dapat menemukan apa yang terjadi!',
			'detail' => 'Silahkan hubungi admin atau kunjungi halaman ini nanti.',
			'code' => 500,
		];
		if(request()->ajax() || request()->is_api){
			$payload['message'] = 'System error';
		}
		if($sqlState || $conn){
			$payload['title'] = 'Query exception';
			switch($sqlState){
				case '42000':
					$payload['message']='Harap perbaiki query database terlebih dahulu!';
					break;
				case '42S02':
					$payload['message']='Base table or view not found';
					break;
				case '42S22':
					$payload['message']='Unknown column';
					break;
				case '1364':
					$payload['message']="Field doesn't have a default value";
					break;
				default: 
					$payload['message']='Harap perbaiki koneksi database terlebih dahulu!';
					$payload['title']='Connection refused';
					break;
			}
		}
		if($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException){
			$payload['title'] = 'Not Found';
			$payload['message'] = 'Halaman yang Anda cari tidak ditemukan';
			$payload['detail'] = 'Bagaimana Anda sampai di sini adalah sebuah misteri.<br>Tetapi Anda dapat mengklik tombol di bawah untuk kembali ke halaman sebelumnya';
			$payload['code'] = 404;
			if(request()->ajax()){
				$payload['message'] = 'Url not found';
			}
		}
		return $payload;
	}
	public static function cekSqlState($e,$code=[]){
		foreach($code as $key => $val){
			if(stripos($e->getMessage(),$val)!==false){
				return $val;
			}
		}
		return false;
	}

	public static function calculateAge($date){
		// Mengubah tanggal lahir menjadi objek DateTime
		$tgl_lahir = new DateTime($date);
		// Objek DateTime untuk tanggal hari ini
		$sekarang = new DateTime();
		// Menghitung selisih antara tanggal lahir dan tanggal hari ini
		$selisih = $tgl_lahir->diff($sekarang);

		// Mendapatkan tahun dan bulan dari selisih
		$tahun = $selisih->y;
		$bulan = $selisih->m;
		$hari = $selisih->d;

		// Format output
		$usia = $tahun . " th";
		if ($bulan > 0) {
			$usia .= " dan " . $bulan . " bln";
		}
		if ($hari > 0) {
			$usia .= " dan " . $hari . " hr";
		}
		return $usia;
	}

	public static function isAgeFiveTeen($date) {
		$tgl_lahir = new DateTime($date);
		$sekarang = new DateTime();
		$selisih = $tgl_lahir->diff($sekarang);

		$tahun = $selisih->y;
		$bulan = $selisih->m;
		$hari = $selisih->d;

		if($tahun >= 15){
			return true;
		}
		return false;
	}

	
	public static function resJson($request){
		$request->merge(['success' => is_bool($request->success) ? $request->success : true]);
		$array = [
			'success' => $request->success,
			'message' => $request->message ? : 'Ok',
		];
		if($request->success && $request->data){
			$array['data'] = $request->data;
		}
		if(!$request->success){
			$array['error_code'] = $request->code;
		}
		return response()->json($array,$request->code ? : 200);
	}

	public static function getJenisSasaran($request){
		$text = 'Bumil, menyusui / nifas';
		if($request->jenis=='bayi_balita_apras'){
			$text = 'Sasaran bayi balita dan apras';
		}
		if($request->jenis=='usia_sekolah_remaja'){
			$text = 'Usia sekolah dan remaja';
		}
		if($request->jenis=='usia_sekolah_remaja'){
			$text = 'Usia produktif dan lansia';
		}
		return $text;
	}

	public static function hitungUmur($request){
		$birthDate = new DateTime($request->tanggal_lahir);
		$today = new DateTime("today");
		if ($birthDate > $today) {
			return response()->json([
				'tahun' => 0,
				'bulan' => 0,
				'hari' => 0,
			]);
		}
		return response()->json([
			'tahun' => $today->diff($birthDate)->y,
			'bulan' => $today->diff($birthDate)->m,
			'hari' => $today->diff($birthDate)->d,
		]);
	}

	public static function statusBB($request){
		// $data = Screening::with(['pasien' => function ($q) use ($request) {
		// 	$q->where('nik_pasien',$request->nik);
		// },'screening_ibu'])->orderBy('tanggal','desc')->first();
		$data = PasienCurrentData::where('nik_pasien',$request->nik)->first();
		if($data){
			if($request->value > $data->bb){
				return 'NAIK (N)';
			}else{
				return 'TIDAK NAIK (TN)';
			}
		}
		return 'TIDAK NAIK (TN)';
	}
	public static function statusLila($request){
		if(floatval($request->value) <= floatval(23.5)){
			return 'MERAH (M)';
		}elseif(floatval($request->value) > floatval(23.5)){
			return 'HIJAU (H)';
		}else{
			return 'KUNING (K)';
		}
		return false;
	}
	public static function statusTekananDarah($request){
		if($request->value){
			$value = explode('/',$request->value);
			$siastole = $value[0];
			// $diastole = $value[1];

			if($siastole <= 90){
				return 'Rendah';
			}elseif($siastole >= 90 && $siastole <=139){
				return 'Normal';
			}elseif($siastole >= 140){
				return 'Tinggi';
			}
		}
		return false;
	}
	public static function skorTBC($request){
      if($request->skor_tbc>=2){
         return 'true';
      }
	}
	public static function statusImt($request){
		if(explode('|',$request->value)[0] && explode('|',$request->value)[1]){
			$imt = explode('|',$request->value)[0]/((explode('|',$request->value)[1]/100)*(explode('|',$request->value)[1]/100));
			if($imt < 17){
				return 'Sangat Kurus (SK)';
			}elseif($imt >= 17 && $imt <18.5){
				return 'Kurus (K)';
			}elseif($imt >= 18.5 && $imt <=25){
				return 'Normal (N)';
			}elseif($imt > 25 && $imt <=27){
				return 'Gemuk (G)';
			}elseif($imt > 27){
				return 'Obesitas (Ob)';
			}
		}
		return false;
	}
	public static function statusPuma($request){
		$data = Pasien::where('nik_pasien',$request->nik)->first();
		$skor = 0;
		if($request->value && $data){
			$skor = $data->jenis_kelamin=="L"?1:0;
			$umur = date_diff(date_create($data->tgl_lahir),date_create(date('Y-m-d')))->d;
			if ($umur<18250) {
				$skor+=0;
			}elseif ($umur>=18250&&$umur<=21899) {
				$skor+=1;
			}else {
				$skor+=2;
			}
			$skor += array_sum(explode('|',$request->value));
			if($skor < 6){
				return $skor.' (Tidak Berisiko / Edukasi)';
			}elseif($skor >= 6){
				return $skor.' (Beresiko / Rujuk)';
			}
		}
		return false;
	}
	public static function statusAks($request){
		$skor = 0;
		if($request->value){
			$skor += array_sum(explode('|',$request->value));
			if ($skor<=4) {
				return "(T=$skor) Total";
			}elseif ($skor>=5&&$skor<=8) {
				return "(B=$skor) Berat";
			}elseif ($skor>=9&&$skor<=11) {
				return "(S=$skor) Sedang";
			}elseif ($skor>=12&&$skor<=19) {
				return "(R=$skor) Ringan";
			}else {
				return "(M=$skor) Mandiri";
			}
		}
		return false;
	}
	public static function statusPbu($request) {
		$data = Pasien::where('nik_pasien',$request->nik)->first();
		if ($data) {
			$umurBulan = floor((date_diff(date_create($data->tgl_lahir),date_create(date('Y-m-d')))->d)/30);
			$antropometri = Antropometri::where('gender',$data->jenis_kelamin)
				->where('type','pb_for_age')
				->where('month',$umurBulan)
				->first();
			if ($antropometri) {
				# C=m, J=sd1, H=sd1neg
				# jika bb < C maka (bb-C)/(C-H)
				# jika tidak (bb-C)/(J-C)
				$zScore = 0;
				if ($request->value < $antropometri->m) {
					$zScore = ($request->value - $antropometri->m)/($antropometri->m - $antropometri->sd1neg);
				} else {
					$zScore = ($request->value - $antropometri->m)/($antropometri->sd1 - $antropometri->m);
				}
				if ($zScore<-3) {
					return "Sangat Pendek (Severely Stunted)";
				} elseif ($zScore>=-3&&$zScore<-2) {
					return "Pendek (Stunted)";
				} elseif ($zScore>=-2&&$zScore<1) {
					return "Normal";
				} else {
					return "Tinggi";
				}
			}
		}
		return false;
	}
	public static function statusBbu($request) {
		$data = Pasien::where('nik_pasien',$request->nik)->first();
		if ($data) {
			$umurBulan = floor((date_diff(date_create($data->tgl_lahir),date_create(date('Y-m-d')))->d)/30);
			$antropometri = Antropometri::where('gender',$data->jenis_kelamin)
				->where('type','bb_for_age')
				->where('month',$umurBulan)
				->first();
			if ($antropometri) {
				# C=m, I=sd1, G=sd1neg
				# jika bb < C maka (bb-C)/(C-G)
				# jika tidak (bb-C)/(I-C)
				$zScore = 0;
				if ($request->value < $antropometri->m) {
					$zScore = ($request->value - $antropometri->m)/($antropometri->m - $antropometri->sd1neg);
				} else {
					$zScore = ($request->value - $antropometri->m)/($antropometri->sd1 - $antropometri->m);
				}
				if ($zScore<-3) {
					return "Berat Badan Sangat Kurang (Severely Underweight)";
				} elseif ($zScore>=-3&&$zScore<-2) {
					return "Berat Badan Kurang (Underweight)";
				} elseif ($zScore>=-2&&$zScore<1) {
					return "Berat Badan Normal";
				} else {
					return "Resiko berat badan lebih";
				}
			}
		}
		return false;
	}
	public static function statusLilaBayi($request) {
		if ($request->value) {
			if ($request->value<11.5) {
				return "Gizi Buruk";
			} elseif ($request->value>=11.5&&$request->value<12.5) {
				return "Kuning (Gizi Kurang)";
			} else {
				return "Hijau (Gizi Baik)";
			}
		}
		return false;
	}
	public static function statusKesehatanJiwa($request) {
		$point = 0;
		foreach (explode(',',$request->value) as $key => $value) {
			if ($key==16 && (boolean)$value) {
				return 'Abnormal';
			}
			if ($value) {
				$point += 1;
			}
		}
		if ($point>=6) {
			return 'Abnormal';
		}else{
			return 'Normal';
		}
	}
}
