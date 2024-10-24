<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Libraries\Datagrid;

class Pasien extends Model
{
	protected $table = "pasien";
	protected $primaryKey = "id_pasien";
	protected $fillable = [
        'id',
		'nama_pasien',
		'nama_pasangan',
		'alamat_pasien',
		'no_asuransi_pasien',
		'jenis_asuransi_pasien',
		'nik_pasien',
		'status_kewarganegaraan',
		'no_telepon',
		'gol_darah',
		'nama_ayah',
		'nama_ibu',
		'jenis_kelamin',
		'tempat_lahir',
		'tgl_lahir',
		'agama',
		'pendidikan_terakhir',
		'status_pernikahan',
		'jenis_pekerjaan',
		'kd_pasien',
		'puskesmas_id',
		'provinsi_id',
		'kabupaten_id',
		'kecamatan_id',
		'desa_id',
		'no_rm_lama'
	];

	public function mst_provinsi(){
		return $this->belongsTo('App\Models\Provinsi','provinsi_id');
	}
	public function provinsi_dom(){
		return $this->belongsTo('App\Models\Provinsi','provinsi_id_domisili');
	}
	public function mst_kabupaten(){
		return $this->belongsTo('App\Models\Kabupaten','kabupaten_id');
	}
	public function kabupaten_dom(){
		return $this->belongsTo('App\Models\Kabupaten','kabupaten_id_domisili');
	}
	public function mst_kecamatan(){
		return $this->belongsTo('App\Models\Kecamatan','kecamatan_id');
	}
	public function kecamatan_dom(){
		return $this->belongsTo('App\Models\Kecamatan','kecamatan_id_domisili');
	}
	public function mst_kelurahan(){
		return $this->belongsTo('App\Models\Desa','desa_id');
	}
	public function kelurahan_dom(){
		return $this->belongsTo('App\Models\Desa','desa_id_domisili');
	}

	public function puskesmas(){
		return $this->belongsTo('App\Models\Puskesmas','puskesmas_id');
	}
	public function sasaran() {
		return $this->hasOne('App\Models\Posyandu\Sasaran','pasien_id','id_pasien');
	}
	public function screening() {
		return $this->hasMany('App\Models\Posyandu\Screening','pasien_id','id_pasien');
	}
	public function anak(){
		return $this->belongsTo('App\Models\Posyandu\Sasaran','nik_ibu','nik_pasien');
	}
	public function data_ibu(){
		return $this->hasOne('App\Models\Pasien','nik_pasien','nik_ibu');
	}

	public function scopeExclude($query,$columns){
		return $query->select(array_diff($this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable()),(array)$columns));
	}

	public static function getData($input)
	{
		$table = "pasien";
		$select = "*";

		$replace_field = [
		];

		$param = [
			'input' => $input->all(),
			'select' => $select,
			'table' => $table,
			'replace_field' => $replace_field,
		];

		$datagrid = new Datagrid;
		$data = $datagrid->datagrid_query($param, function($data){
			return $data;
		});
		return $data;
	}

	public static function storeFromScreeningPosyandu($param)
	{
		$data = Pasien::where('nik_pasien',$param->nik)->first();
		$data->no_telepon = $param->nomor_telepon;
		$data->save();
		return $data?:false;
	}

	public static function storeFromPosyandu($param)
	{
		if(!$param->newIbu){
			$data = ($param->id_pasien) ? Pasien::where(['id_pasien'=>$param->id_pasien,'nik_pasien'=>$param->nik])->first() : new Pasien;
			$data->nik_pasien 					= $param->nik;
			$data->nama_pasien 					= $param->nama_lengkap;
			$data->jenis_kelamin 				= $param->jenis_kelamin;
			$data->tempat_lahir 				= $param->tempat_lahir;
			$data->tgl_lahir 					= $param->tgl_lahir;
			//bumil || produktif lansia
			$data->status_pernikahan 			= $param->status_pernikahan;
			$data->nama_pasangan = $param->nama_pasangan;
			//bayi
			$data->berat_badan					= $param->berat_badan_lahir;
			$data->tinggi_badan					= $param->panjang_badan_lahir;
			$data->nik_ibu	 					= $param->nik_ibu;
			$data->nama_ibu 					= $param->nama_ibu;//+remaja
			$data->nama_ayah 					= $param->nama_ayah;//+ramaja
			
		}else{
			$data = new Pasien;
			$data->nik_pasien	 				= $param->nik_ibu;
			$data->nama_pasien 					= $param->nama_ibu;
			$data->jenis_kelamin 				= 'P';
			$data->nama_pasangan				= $param->nama_ayah;
		}
		// alamat ktp
		$data->alamat_pasien 				= $param->alamat;
		$data->rt 							= $param->rt;
		$data->rw 							= $param->rw;
		$data->provinsi_id 					= $param->provinsi_id;
		$data->kabupaten_id 				= $param->kabupaten_id;
		$data->kecamatan_id 				= $param->kecamatan_id;
		$data->desa_id 						= $param->desa_id;
		// sama ktp
		if(!empty($param->sama_ktp)){
			$data->ktp_domisili 				= true;
		}else{
			$data->ktp_domisili 				= false;
			// alamat domisili
			$data->alamat_domisili 				= $param->alamat_domisili;
			$data->rt_domisili 					= $param->rt_domisili;
			$data->rw_domisili 					= $param->rw_domisili;
			$data->provinsi_id_domisili 		= $param->provinsi_domisili;
			$data->kabupaten_id_domisili 		= $param->kabupaten_kota_domisili;
			$data->kecamatan_id_domisili 		= $param->kecamatan_domisili;
			$data->desa_id_domisili 			= $param->desa_domisili;
		}

		$data->no_telepon 					= $param->nomor_telepon;
		$data->email 						= $param->email;

		$data->save();
		return $data?:false;
	}

}
