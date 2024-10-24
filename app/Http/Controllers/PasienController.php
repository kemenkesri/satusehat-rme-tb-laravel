<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Libraries\Datagrid;
use App\Http\Libraries\LPasien;
use App\Models\Pasien;
use App\Models\Antrian;
use App\Models\Provinsi;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Desa;

use App\Http\Libraries\Activitys;
use Maatwebsite\Excel\Exceptions\NoTypeDetectedException;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
// use Auth, Redirect, Validator, Session, DB, DataTables, URL, File, Excel, DateTime;
use Illuminate\Support\Facades\Log;

class PasienController extends Controller
{
	private $title = "Data Pasien";
	private $menuActive = "pasien";
	private $submnActive = "";

	public function main()
	{
		$this->data['title'] = $this->title;
		$this->data['mn_active'] = $this->menuActive;
		$this->data['submn_active'] = $this->submnActive;
		$this->data['smallTitle'] = "";

		$data['mn_active'] = $this->menuActive;

		return view($this->menuActive.'.main', $data)->with('data', $this->data);
	}

	public function datagrid(Request $request)
	{		
		$data = Pasien::orderBy('id_pasien','DESC');	
		
		return Datatables::of($data)
		->addIndexColumn()		
		->addColumn('aksi', function($row){

			$aksi = '<a href="javascript:void(0)" onclick="detailForm('.$row->id_pasien.')" class="btn btn-warning btn-sm text-white mr-1"><i class="fa fa-eye"></i></a>'.
			'<a href="javascript:void(0)" onclick="editForm('.$row->id_pasien.')" class="btn btn-primary btn-sm mr-1"><i class="fa fa-edit"></i></a>'.
			'<a href="javascript:void(0)" onclick="deleteForm('.$row->id_pasien.')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';

			return $aksi;
		})
		->rawColumns(['aksi'])
		->make(true);
	}

	public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
		try {
			DB::beginTransaction();
			$import = Excel::import(new PasienImport,$file);
		} catch (NoTypeDetectedException $e) {
			DB::rollback();
			return ['status'=>'error','message' => 'Gagal Import Excel','messageErr' => $e ,'title' => 'Success'];
		}

		DB::commit();
		return ['status'=>'success','message' => 'Berhasil Import Excel','title' => 'Success'];
    }

	public function form(Request $request)
	{
		$data_provinsi = Provinsi::all();
		$data = [
			'data_provinsi' => $data_provinsi,
			'jenis'=> isset($request->jenis) ? $request->jenis : '',
		];
		if (empty($request->id)) {
			if(isset($request->id_antrian)){
				$antrian = Antrian::find($request->id_antrian);
			}else{
				$antrian = '';
			}

			$data1 = [
				'menu'=>'Tambah Pasien',
				'antrian'=>$antrian,
				'users'=>'',
                'kd_pasien' => '1'
			];
		}else{
			$pasien = Pasien::where('id_pasien',$request->id)->first();
			$namaProv = !empty(Provinsi::where('KD_PROVINSI', $pasien->provinsi_id)->first()) ? Provinsi::where('KD_PROVINSI', $pasien->provinsi_id)->first()->PROVINSI : "";
			$namaKab = !empty(Kabupaten::where('KD_KABUPATEN', $pasien->kabupaten_id)->first()) ? Kabupaten::where('KD_KABUPATEN', $pasien->kabupaten_id)->first()->KD_KABUPATEN : "";
			$namaKec = !empty(Kecamatan::where('KD_KECAMATAN', $pasien->kecamatan_id)->first()) ? Kecamatan::where('KD_KECAMATAN', $pasien->kecamatan_id)->first()->KD_KECAMATAN : "";
			$namaKel = !empty(Desa::where('KD_KELURAHAN', $pasien->desa_id)->first()) ? Desa::where('KD_KELURAHAN', $pasien->desa_id)->first()->KD_KELURAHAN : "";
			$prov = $namaProv;
			$kab = $namaKab;
			$kec = $namaKec;
			$kel = $namaKel;

			$data1 = [
				'menu'=>'Tambah Pasien',
				'pasien'=>$pasien,
				'prov'=>$prov,
				'kab'=>$kab,
				'kec'=>$kec,
				'kel'=>$kel,
				'users'=>1
			];
		}
		$data = array_merge($data,$data1);
		$content = view('pasien.form',$data)->render();
		$return = [
			'status'=>'success',
			'code'=>200,
			'message'=>'Berhasil',
			'content'=>$content
		];
		return response()->json($return);
	}

	public function cariPasien(Request $request)
	{
		$data = Pasien::where("nama_pasien", "LIKE",  strtoupper("%$request->nama%"))->where("nik_pasien", "LIKE", "%$request->nik%")->get();
		$return = ['status'=>'success',	'code'=>200, 'data'=>$data];
		return response()->json($return);
	}

	public function getDatapasien(Request $request){
		$data = Pasien::where('nik_pasien', $request->nik)->first();
		$return = ['status'=>'success','code'=>200,'data'=>$data];
		return response()->json($return);
	}

	public function save(Request $request)
	{
		$simpan = LPasien::simpan($request);
		if ($simpan['status']=='success') {
			Session::flash('title','Success');
			if (empty($request->id_pasien)) {
				Session::flash('message','Berhasil menyimpan data');
			}else{
				Session::flash('message','Berhasil mengubah data');
			}
			Session::flash('type','success');						
			$data = [
				'type'=>'success',
				'status'=>'success',
				'code'=>200,
				'alert'=>'alert',
				'head_message'=>'Success!',
				'message'=>'Berhasil menyimpan data',
				'data'=>$simpan['pasien'],
			];
		} else if($simpan['status']=='warning') {
			$data = [
				'type'=>'info',
				'status'=>'info',
				'code'=>240,
				'alert'=>'alert',
				'head_message'=>'Pemberitahuan!',
				'message'=>'Pasien Sudah Terdaftar',
				'data'=> $simpan['dataPasien'],
			];
		} else {
			$data = [
				'type'=>'error',
				'status'=>'error',
				'code'=>250,
				'alert'=>'alert',
				'head_message'=>'Maaf!',
				'message'=>'Gagal menyimpan data',
				'data'=>$simpan['pasien'],
			];
		}

		return $data;
	}

	public function delete(Request $request)
	{
		$pasien = Pasien::where('id_pasien',$request->id)->first();
		$pasien->delete();

		if ($pasien) {						
			$data = [
				'status'=>'success',
				'code'=>200,
				'alert'=>'alert',
				'head_message'=>'Success!',
				'message'=>'Berhasil menghapus data',
			];
		}else{
			$data = [
				'status'=>'error',
				'code'=>250,
				'alert'=>'alert',
				'head_message'=>'Maaf!',
				'message'=>'Gagal menghapus data',
			];
		}

		return $data;
	}	

	public function detail(Request $request)
	{
		$pasien = Pasien::where('id_pasien',$request->id)->first();
		if (!empty($pasien->tgl_lahir)) {
	        $lahir = new DateTime($pasien->tgl_lahir);
	        $hari_ini = new DateTime();
	        $diff = $hari_ini->diff($lahir);
	        $pasien->usia = $diff->y ." Tahun ".$diff->m ." Bulan";
	      }else{
	        $pasien->usia = '';
	      }

		$data = [
			'menu'=>'Detail Pasien',
			'pasien'=>$pasien
		];
		$content = view('pasien.detail',$data)->render();
		$return = [
			'status'=>'success',
			'code'=>200,
			'message'=>'Berhasil',
			'content'=>$content
		];
		return response()->json($return);
	}
}
