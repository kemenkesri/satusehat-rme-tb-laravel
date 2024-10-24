<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Kabupaten;
use App\Models\Provinsi;
use App\Models\Pasien;
use App\Models\Antrian;
use File, Auth, Redirect, Validator, DB;

class GetController extends Controller{
	function getKabupaten(Request $request){
		$KD_PROVINSI = $request->id;
		$kabupaten = Kabupaten::where('KD_PROVINSI',$KD_PROVINSI)->get();

		if(count($kabupaten)!=0){
			$return = [
				'status'=>'success',
				'message'=>'Data ditemukan',
				'data'=>$kabupaten,
			];
		}else{
			$return = [
				'status'=>'error',
				'message'=>'Data tidak ditemukan',
				'data'=>[],
			];
		}
		return $return;
	}

	function getKecamatan(Request $request){
		$KD_KABUPATEN = $request->id;
		$kecamatan = Kecamatan::where('KD_KABUPATEN',$KD_KABUPATEN)->get();

		if(count($kecamatan)!=0){
			$return = [
				'status'=>'success',
				'message'=>'Data ditemukan',
				'data'=>$kecamatan,
			];
		}else{
			$return = [
				'status'=>'error',
				'message'=>'Data tidak ditemukan',
				'data'=>[],
			];
		}
		return $return;
	}

	function getDesa(Request $request){
		$KD_KECAMATAN = $request->id;
		$desa = Desa::where('KD_KECAMATAN',$KD_KECAMATAN)->get();
		if(count($desa)!=0){
			$return = [
				'status'=>'success',
				'message'=>'Data ditemukan',
				'data'=>$desa,
			];
		}else{
			$return = [
				'status'=>'error',
				'message'=>'Data tidak ditemukan',
				'data'=>[],
			];
		}
		return $return;
	}

	public function Pasien(Request $request){
		try {
			$pasien = Pasien::select('id_pasien', 'kd_pasien')->get();
			foreach ($pasien as $key => $v) {
				$kdcount = $v->kd_pasien;
				if (strlen($kdcount) > 7) {
					$kd = substr($v->kd_pasien,11);
					$pas = Pasien::where('id_pasien', $v->id_pasien)->first();
					$pas->kd_pasien = $kd;
					$pas->save();
				}
				
			}
			return 'Selesai';
		} catch (\Throwable $th) {
			return $th->getMessage();
		}
	}

	public function searchDataPasienByNik(Request $request){
		$where = "nik_pasien LIKE '%$request->nik%'";
		if($request->sasaran=='ibu'){
			$where .= " AND (jenis_kelamin='P' OR jenis_kelamin IS NULL)";
		}
		// $data = Pasien::where('nik_pasien', 'like', '%'.$request->nik.'%')->with('puskesmas')->limit(5)->get();
		$data = Pasien::whereRaw($where)->with('puskesmas')->limit(5)->get();
		if(count($data)>0){
			return ['code'=>200,'type'=>'success','message'=>'Data ditemukan','data'=>$data];
		}
		return ['code'=>400,'type'=>'error','message'=>'Data tidak ditemukan', 'data'=>[]];
	}
	public function chooseDataPasien(Request $request){
		$data = Pasien::where('id_pasien', $request->id)->first();
		if($data){
			return ['code'=>200,'type'=>'success','message'=>'Data ditemukan','data'=>$data];
		}
		return ['code'=>400,'type'=>'error','message'=>'Data tidak ditemukan', 'data'=>[]];
	}

	function get_obat_satu_sehat(Request $request){
		$cari = $request->cari;
		$satuan = $request->satuan;
		$obat = DB::table('obat_satu_sehat')
		->selectRaw("display_name_pa2,kode_pa2,satuan_disesuaikan_b,display_name_sediaan")
		->whereRaw("display_name_pa2 ILIKE '%".$cari."%'")
		->orderBy('display_name_pa2')
		->distinct('display_name_pa2')
		->limit(10)
		->get();

		// AND satuan_disesuaikan_b like '%".$satuan."%' 
		// $pasien = Pasien::where('puskesmas_id',Auth::getUser()->puskesmas_id)
		// ->whereRaw("UPPER(nama_pasien) LIKE '%".strtoupper($cari)."%' 
		// 	OR nik_pasien like '%".$cari."%' 
		// 	OR no_asuransi_pasien like '%".$cari."%' 
		// 	OR kd_pasien like '%".$cari."%' 
		// 	OR alamat_pasien like '%".$cari."%'")
		// ->orderByRaw("CHAR_LENGTH(nama_pasien)")
		// ->limit(10)->get();


		return ['obat'=>$obat];
	}

	 // UPDATE NO.RM TO ANTRIAN 
	//  public function updateRM(Request $request)
	// {
	// 	try {
	// 	    $antrian = Antrian::select('id_antrian', 'kd_pasien')->get();
			 
	// 	    foreach ($antrian as $key => $ant) {
	// 	      // GET ID PASIEN
	// 	      $id = $ant->kd_pasien;

	// 	      if (!empty($id)) {
	// 	        // GET PASIEN
	// 	        $getPasien = Pasien::where('id_pasien', $id)->first();

	// 	        if (!empty($getPasien)) {
	// 	          $updateAntrian = Antrian::where('kd_pasien',$id)->update(['no_rm' => $getPasien->kd_pasien]);
				  
	// 			  if ($updateAntrian) {
	// 				$upPasien = DB::connection('pgsql3')->table('pasien')->where('id_pasien',$id)->update(['ada'=>'Y']);
	// 				// $upPasien = Pasien::where('id_pasien', $id)->update(['ada' => 'Y']);
	// 			  }
	// 	        }
	// 	      }
				
	// 	    }

	// 		return 'Selesai';
	// 	} catch (\Throwable $th) {
	// 		return $th->getMessage();
	// 	}

	// 	// SINKRONISASI DATA PASIEN
	// 	// $getPas = DB::connection('pgsql2')->table('pasien')->where('test',null)->limit(15000)->get();
	// 	// // return $getPas;
	// 	// $arr = [];
	// 	// foreach($getPas as $key => $val){
	// 	// 	// $up = Pasien::where('id_pasien',$val->id_pasien)->first();
	// 	// 	// $up->tes = 'sudah';
	// 	// 	// $up->save();
	// 	// 	$up = DB::connection('pgsql2')->table('pasien')->where('id_pasien',$val->id_pasien)->update(['test'=>'sudah']);
	// 	// 	$sim3 = DB::connection('pgsql3')->table('pasien')->where('id_pasien',$val->id_pasien)->first();
	// 	// 	if(empty($sim3)){
	// 	// 		$arr[] = $val->id_pasien;
	// 	// 		$sim4 = DB::connection('pgsql3')->table('pasien')->insert([
	// 	// 			"id_pasien" => $val->id_pasien,
	// 	// 			"nama_pasien" => $val->nama_pasien,
	// 	// 			"alamat_pasien" => $val->alamat_pasien,
	// 	// 			"no_asuransi_pasien" => $val->no_asuransi_pasien,
	// 	// 			"jenis_asuransi_pasien" => $val->jenis_asuransi_pasien,
	// 	// 			"nik_pasien" => $val->nik_pasien,
	// 	// 			"status_kewarganegaraan" => $val->status_kewarganegaraan,
	// 	// 			"paspor" => $val->paspor,
	// 	// 			"kewarganegaraan" => $val->kewarganegaraan,
	// 	// 			"provinsi_id" => $val->provinsi_id,
	// 	// 			"kabupaten_id" => $val->kabupaten_id,
	// 	// 			"kecamatan_id" => $val->kecamatan_id,
	// 	// 			"desa_id" => $val->desa_id,
	// 	// 			"kode_pos" => $val->kode_pos,
	// 	// 			"no_telepon" => $val->no_telepon,
	// 	// 			"jenis_no_telepon" => $val->jenis_no_telepon,
	// 	// 			"surat_elektronik" => $val->surat_elektronik,
	// 	// 			"gol_darah" => $val->gol_darah,
	// 	// 			"nama_ayah" => $val->nama_ayah,
	// 	// 			"nama_ibu" => $val->nama_ibu,
	// 	// 			"nama_pasangan" => $val->nama_pasangan,
	// 	// 			"jenis_kelamin" => $val->jenis_kelamin,
	// 	// 			"tempat_lahir" => $val->tempat_lahir,
	// 	// 			"tgl_lahir" => $val->tgl_lahir,
	// 	// 			"tgl_kematian" => $val->tgl_kematian,
	// 	// 			"agama" => $val->agama,
	// 	// 			"pendidikan_terakhir" => $val->pendidikan_terakhir,
	// 	// 			"status_pernikahan" => $val->status_pernikahan,
	// 	// 			"jenis_pekerjaan" => $val->jenis_pekerjaan,
	// 	// 			"suku" => $val->suku,
	// 	// 			"ket_identitas_pasien" => $val->ket_identitas_pasien,
	// 	// 			"kd_pasien" => $val->kd_pasien,
	// 	// 			"puskesmas_id" => $val->puskesmas_id,
	// 	// 		]);
	// 	// 	}
	// 	// }
  	// 	// return $arr;
	// 	// return $sim4;
	// 	// return "tes";
	// }
}