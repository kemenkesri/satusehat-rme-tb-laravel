<?php
namespace App\Http\Libraries;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Puskesmas;
use Auth;

class LPasien
{
	public static function simpan(Request $request){
		if (empty($request->id_pasien)) {
			$dtPasien = Pasien::where('nama_pasien', $request->nama_pasien)->where('nik_pasien', $request->nik_pasien)->first();
			if (!empty($dtPasien)) {
				$pasien = 'ada';
			} else {
				$pasien = new Pasien;				
				$kd_pasien = '0000001';
				$pasien->kd_pasien 	= $kd_pasien;
			}
		}else{
			$pasien = Pasien::where('id_pasien',$request->id_pasien)->first();
		}

		if ($pasien == 'ada') {
			return ['status'=>'warning', 'dataPasien'=>$dtPasien];
		} else {
			$pasien->nama_pasien 				= $request->nama_pasien;
			$pasien->alamat_pasien 				= $request->alamat_pasien;
			$pasien->no_asuransi_pasien 		= $request->no_asuransi_pasien;
			$pasien->jenis_asuransi_pasien 		= $request->jenis_asuransi_pasien;
			$pasien->nik_pasien 				= $request->nik_pasien;
			$pasien->status_kewarganegaraan 	= $request->status_kewarganegaraan;
			$pasien->paspor 					= $request->paspor;
			$pasien->kewarganegaraan 			= $request->kewarganegaraan;
			$pasien->provinsi_id 				= $request->provinsi_id;
			$pasien->kabupaten_id 				= $request->kabupaten_id;
			$pasien->kecamatan_id 				= $request->kecamatan_id;
			$pasien->desa_id 					= $request->desa_id;
			$pasien->kode_pos 					= $request->kode_pos;
			$pasien->no_telepon 				= $request->no_telepon;
			$pasien->jenis_no_telepon 			= $request->jenis_no_telepon;
			$pasien->surat_elektronik 			= $request->surat_elektronik;
			$pasien->gol_darah 					= $request->gol_darah;
			$pasien->nama_ayah 					= $request->nama_ayah;
			$pasien->nama_ibu 					= $request->nama_ibu;
			$pasien->nama_pasangan 				= $request->nama_pasangan;
			$pasien->jenis_kelamin 				= $request->jenis_kelamin;
			$pasien->tempat_lahir 				= $request->tempat_lahir;
			$pasien->tgl_lahir 					= $request->tgl_lahir;
			$pasien->tgl_kematian 				= $request->tgl_kematian;
			$pasien->agama 						= $request->agama;
			$pasien->pendidikan_terakhir 		= $request->pendidikan_terakhir;
			$pasien->status_pernikahan 			= $request->status_pernikahan;
			$pasien->jenis_pekerjaan 			= $request->jenis_pekerjaan;
			$pasien->suku 						= $request->suku;
			$pasien->ket_identitas_pasien 		= $request->ket_identitas_pasien;
			$pasien->kode_provider 				= $request->kode_provider;
			$pasien->nama_provider				= $request->nama_provider;
			$pasien->riwayat_alergi				= $request->riwayat_alergi;
			#new
			$pasien->rt							= $request->rt;
			$pasien->rw							= $request->rw;			
			$pasien->puskesmas_id 				= 1;
			$pasien->save();

			if($pasien){
				return ['status'=>'success','pasien'=>$pasien];
			}else{
				return ['status'=>'error'];
			}
		}
	}
}
