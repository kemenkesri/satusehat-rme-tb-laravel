<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Mediator\MediatorController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Provinsi;
use App\Models\Pasien;

use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\TbTerduga;
use Illuminate\Support\Facades\Session;

// use Auth, Redirect, Validator, Session, DB, DataTables, URL, File, Excel, DateTime;
use Yajra\DataTables\Facades\DataTables;

class TbTerdugaController extends Controller
{
    // protected $satuSehatService;

    // public function __construct(SatuSehatService $satuSehatService)
    // {
    //     $this->satuSehatService = $satuSehatService;
    // }


    // public function __construct(SatuSehatService $satuSehatService)
    // {
    //     $this->satuSehatService = $satuSehatService;
    // }

    private $title = "Data Terduga TB";
    private $menuActive = "tb_terduga";
    private $submnActive = "";

    public function main()
    {
        $this->data['title'] = $this->title;
        $this->data['mn_active'] = $this->menuActive;
        $this->data['submn_active'] = $this->submnActive;
        $this->data['smallTitle'] = "";

        $data['mn_active'] = $this->menuActive;

        return view($this->menuActive . '.main', $data)->with('data', $this->data);
    }

      public function autocomplete(Request $request)
    {
        $search = $request->get('query'); // Ambil input dari request
        $pasien = Pasien::where('nama_pasien', 'LIKE', "%{$search}%")
                    ->orWhere('nik_pasien', 'LIKE', "%{$search}%")
                    ->get(); // Cari berdasarkan nama atau NIK pasien

        // Ubah hasil menjadi format yang sesuai untuk autocomplete (misalnya nama dan NIK)
        $response = [];
        foreach ($pasien as $p) {
            $response[] = [
                'value' => $p->nama_pasien,
                'label' => $p->nama_pasien . ' (' . $p->nik_pasien . ')',
            ];
        }

        return response()->json($response); // Kembalikan hasil dalam bentuk JSON
    }


    public function datagrid(Request $request)
    {
        // $data = TbTerduga::orderBy('id', 'DESC');
        $data = TbTerduga::selectRaw("
            id,
            no_sediaan,
            tipe_pasien_id,
            terduga_tb_id,
            CASE
                WHEN terduga_tb_id = '1' THEN 'Terduga TB SO'
                ELSE 'Terduga TB RO'
            END as jenis_terduga,
            CASE
                WHEN tipe_pasien_id = '1' THEN 'Baru'
                WHEN tipe_pasien_id = '2' THEN 'TBC Ekstra Paru'
                WHEN tipe_pasien_id = '3' THEN 'Diobati setelah gagal kategori 1'
                WHEN tipe_pasien_id = '4' THEN 'Diobati setelah gagal kategori 2'
                WHEN tipe_pasien_id = '5' THEN 'Diobati setelah putus berobat'
                WHEN tipe_pasien_id = '6' THEN 'Diobati setelah gagal pengobatan lini 2'
                WHEN tipe_pasien_id = '7' THEN 'Pernah diobati tidak diketahui hasilnya'
                WHEN tipe_pasien_id = '8' THEN 'Tidak diketahui'
                WHEN tipe_pasien_id = '9' THEN 'Lain-lain'
                WHEN tipe_pasien_id = '10' THEN 'Diobati setelah gagal'
                ELSE 'Tidak Diketahui'
            END as jenis_pasien,
            pasien.nama_pasien as nama_pasien
        ")
         ->join('pasien', DB::raw('CAST(tb_terduga.person_id AS bigint)'), '=', 'pasien.id_pasien')
          ->orderBy('id', 'DESC');
        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {

                // echo '<pre>';
                // var_dump($row);die;
                $aksi = '<a href="javascript:void(0)" onclick="detailForm(\'' . $row->id . '\')" class="btn btn-warning btn-sm text-white mr-1"><i class="fa fa-eye"></i></a>' .
                    '<a href="javascript:void(0)" onclick="editForm(\'' . $row->id . '\')" class="btn btn-primary btn-sm mr-1"><i class="fa fa-edit"></i></a>' .
                    '<a href="javascript:void(0)" onclick="deleteForm(\'' . $row->id . '\')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';


                return $aksi;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function form(Request $request)
    {
//		$data_provinsi = Provinsi::all();
		$data = [
			'data_provinsi' => [],
			'jenis'=> isset($request->jenis) ? $request->jenis : '',
		];

		if (empty($request->id)) {
	
        $data = Pasien::orderBy('id_pasien','DESC');    


            $pasien = Pasien::all();
			$data1 = [
				'menu'=>'Tambah Data Permohonan Lab',
			 'pasien'=>null,
               'kd_pasien' => '1'
			];
		}else{
			$permohonan_lab = TbTerduga::where('id',$request->id)->first();
			// $namaProv = !empty(Provinsi::where('KD_PROVINSI', $pasien->provinsi_id)->first()) ? Provinsi::where('KD_PROVINSI', $pasien->provinsi_id)->first()->PROVINSI : "";
			// $namaKab = !empty(Kabupaten::where('KD_KABUPATEN', $pasien->kabupaten_id)->first()) ? Kabupaten::where('KD_KABUPATEN', $pasien->kabupaten_id)->first()->KD_KABUPATEN : "";
			// $namaKec = !empty(Kecamatan::where('KD_KECAMATAN', $pasien->kecamatan_id)->first()) ? Kecamatan::where('KD_KECAMATAN', $pasien->kecamatan_id)->first()->KD_KECAMATAN : "";
			// $namaKel = !empty(Desa::where('KD_KELURAHAN', $pasien->desa_id)->first()) ? Desa::where('KD_KELURAHAN', $pasien->desa_id)->first()->KD_KELURAHAN : "";
			// $prov = $namaProv;
			// $kab = $namaKab;
			// $kec = $namaKec;
			// $kel = $namaKel;
                        $pasien = Pasien::all();


			$data1 = [
				'menu'=>'Ubah  Data Permohonan Lab',
				'pasien'=>$permohonan_lab,
				// 'prov'=>$prov,
				// 'kab'=>$kab,
				// 'kec'=>$kec,
				// 'kel'=>$kel,
				// 'users'=>1
			];
		}

        $data = [
            'data_provinsi' => [],
            'jenis' => isset($request->jenis) ? $request->jenis : '',

        ];
        $permohonan_lab = TbTerduga::query()->where('id', $request->id)->first();
        $data1 = [
            'menu' => 'Ubah  Data Permohonan Lab',
            'pasien' => $permohonan_lab,
            'patients'=>$pasien,
            // 'prov'=>$prov,
            // 'kab'=>$kab,
            // 'kec'=>$kec,
            // 'kel'=>$kel,
            // 'users'=>1
        ];
        $data = array_merge($data, $data1);
        $content = view('tb_terduga.form', $data)->render();
        $return = [
            'status' => 'success',
            'code' => 200,
            'message' => 'Berhasil',
            'content' => $content
        ];
        return response()->json($return);
    }


    public function save(Request $request)
    {

        // echo '<pre>';
        // var_dump($request->all());die;
        // Validasi input
        $validatedData = $request->validate([
            'person_id'=>'required',
            'tipe_pasien_id' => 'required',
            'status_dm_id' => 'required',
            'imunisasi_bcg_id' => 'required',
            'status_hiv_id' => 'required',
            'terduga_tb_id' => 'string'
        ]);

        try {
            $permohonanLab = null;
            // Cek apakah terdapat ID, jika ada berarti update, jika tidak berarti create
            if ($request->has('id')) {
                // $response = $this->satuSehatService->createPermohonanLab($validatedData);


                //  if (!empty($response['message']['httpCode'])) {
                // $permohonanLab = TbPermohonanLab::findOrFail($request->id);
                // $permohonanLab->update($validatedData);
                // $message = 'Gagal mengubah data';

                // }else{

                $permohonanLab = TbTerduga::query()->findOrFail($request->id);
                $permohonanLab->update($validatedData);
                $message = 'Berhasil Mengubah data';
                // }

            } else {
                // Hardcoded input values
                    $idPuskesmas = '12345'; // ID PUSKESMAS
                    $tipeTerduga = '1'; // Tipe Terduga

                    // Get current date components
                    $year = date('y'); // YY
                    $month = str_pad(date('m'), 2, '0', STR_PAD_LEFT);
                    $day = date('d'); // DD

                    // Generate random number
                    $randomNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

                    // Concatenate the code
                    $generatedCode = "$year/$idPuskesmas/$tipeTerduga/$month$day/$randomNumber";

                $validatedData['id'] = Str::uuid();

                $validatedData['no_sediaan'] = $generatedCode;
                $permohonanLab = TbTerduga::query()->create($validatedData);
                $message = 'Berhasil menyimpan data';
                // }
            }

            if (!$permohonanLab instanceof TbTerduga) {
                throw new \Exception('Data untuk Tb Terduga belum ada', 404);
            }
            $mediatorController = new MediatorController();

            $mediatorController->terdugaTb($request, $permohonanLab);

            // Mengatur session flash
            Session::flash('title', 'Success');
            Session::flash('message', $message);
            Session::flash('type', 'success');


            return response()->json([
                'type' => 'success',
                'status' => 'success',
                'code' => 200,
                'alert' => 'alert',
                'head_message' => 'Success!',
                'message' => $request->has('id') ? 'Berhasil mengubah data' : 'Berhasil menyimpan data',
                'data' => $permohonanLab
            ]);
            // return response()->json([
            //     'type' => 'error',
            //     'status' => 'error',
            //     'code' => 200,
            //     'alert' => 'alert',
            //     'head_message' => 'Gagal!',
            //     'message' => $request->has('id') ?  'Gagal mengubah data' : 'Gagal menyimpan data',
            //     'data' => $simpan,
            // ]);


            // }else{

            //      // Simpan data
            //         $simpan = TbPermohonanLab::create($validatedData);

            //         // Mengatur session flash
            //         Session::flash('title', 'Success');
            //         Session::flash('message', $request->has('id') ? 'Berhasil mengubah data' : 'Berhasil menyimpan data');
            //         Session::flash('type', 'success');

            //         return response()->json([
            //             'type' => 'success',
            //             'status' => 'success',
            //             'code' => 200,
            //             'alert' => 'alert',
            //             'head_message' => 'Success!',
            //             'message' => $request->has('id') ? 'Berhasil mengubah data' : 'Berhasil menyimpan data',
            //             'data' => $simpan,
            //         ]);
            // }


        } catch (\Exception $e) {
            return response()->json([
                'type' => 'error',
                'status' => 'error',
                'code' => 250,
                'alert' => 'alert',
                'head_message' => 'Maaf!',
                'message' => $e->getMessage(),
                'data' => null,
            ]);
        }
    }


    public function detail(Request $request)
    {
        $permohonan_lab = TbTerduga::where('id', $request->id)->first();


        $data = [
            'menu' => 'Detail Permohonan Lab',
            'permohonan_lab' => $permohonan_lab
        ];
        $content = view('tb_permohonan_lab.detail', $data)->render();
        $return = [
            'status' => 'success',
            'code' => 200,
            'message' => 'Berhasil',
            'content' => $content
        ];
        return response()->json($return);
    }


    public function getDataPermohonanLab(Request $request)
    {

        $permohonan_lab = TbTerduga::where('id', $request->id)->first();

        $return = ['status' => 'success', 'code' => 200, 'data' => $permohonan_lab];
        return response()->json($return);
    }

    public function delete(Request $request)
    {
        $pasien = TbTerduga::where('id', $request->id)->first();
        $pasien->delete();

        if ($pasien) {
            $data = [
                'status' => 'success',
                'code' => 200,
                'alert' => 'alert',
                'head_message' => 'Success!',
                'message' => 'Berhasil menghapus data',
            ];
        } else {
            $data = [
                'status' => 'error',
                'code' => 250,
                'alert' => 'alert',
                'head_message' => 'Maaf!',
                'message' => 'Gagal menghapus data',
            ];
        }

        return $data;
    }

}
