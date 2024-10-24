<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Mediator\MediatorController;
use App\Models\HasilLab;
use App\Models\TbPermohonanLab;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

// use Auth, Redirect, Validator, Session, DB, DataTables, URL, File, Excel, DateTime;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class HasilLabController extends Controller
{

    // protected $satuSehatService;

    // public function __construct(SatuSehatService $satuSehatService)
    // {
    //     $this->satuSehatService = $satuSehatService;
    // }


    private $title = "Data Hasil Lab Pasien";
    private $menuActive = "hasil_lab";
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


    public function datagrid(Request $request)
    {
        $data = HasilLab::orderBy('id', 'DESC');

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
//		$data = [
//			'data_provinsi' => $data_provinsi,
//			'jenis'=> isset($request->jenis) ? $request->jenis : '',
//		];
//		if (empty($request->id)) {
//			if(isset($request->id_antrian)){
//				$antrian = Antrian::find($request->id_antrian);
//			}else{
//				$antrian = '';
//			}
//
//			$data1 = [
//				'menu'=>'Tambah Data Hasil Lab',
//				'antrian'=>$antrian,
//				'users'=>'',
//                'kd_pasien' => '1'
//			];
//		}else{
//			$hasil_lab = HasilLab::where('id',$request->id)->first();
//			// $namaProv = !empty(Provinsi::where('KD_PROVINSI', $pasien->provinsi_id)->first()) ? Provinsi::where('KD_PROVINSI', $pasien->provinsi_id)->first()->PROVINSI : "";
//			// $namaKab = !empty(Kabupaten::where('KD_KABUPATEN', $pasien->kabupaten_id)->first()) ? Kabupaten::where('KD_KABUPATEN', $pasien->kabupaten_id)->first()->KD_KABUPATEN : "";
//			// $namaKec = !empty(Kecamatan::where('KD_KECAMATAN', $pasien->kecamatan_id)->first()) ? Kecamatan::where('KD_KECAMATAN', $pasien->kecamatan_id)->first()->KD_KECAMATAN : "";
//			// $namaKel = !empty(Desa::where('KD_KELURAHAN', $pasien->desa_id)->first()) ? Desa::where('KD_KELURAHAN', $pasien->desa_id)->first()->KD_KELURAHAN : "";
//			// $prov = $namaProv;
//			// $kab = $namaKab;
//			// $kec = $namaKec;
//			// $kel = $namaKel;
//
//			$data1 = [
//				'menu'=>'Ubah  Data Hasil Lab',
//				'pasien'=>$hasil_lab,
//				// 'prov'=>$prov,
//				// 'kab'=>$kab,
//				// 'kec'=>$kec,
//				// 'kel'=>$kel,
//				// 'users'=>1
//			];
//		}

        $patients = TbPermohonanLab::whereNotNull('no_sediaan')->get();

        $hasil_lab = HasilLab::where('id', $request->id)->first();
        $data = [
            'data_provinsi' => [],
            'jenis' => isset($request->jenis) ? $request->jenis : '',
            'patients'=>$patients
        ];
        $data1 = [
            'menu' => 'Ubah  Data Hasil Lab',
            'pasien' => $hasil_lab,
            // 'prov'=>$prov,
            // 'kab'=>$kab,
            // 'kec'=>$kec,
            // 'kel'=>$kel,
            // 'users'=>1
        ];
        $data = array_merge($data, $data1);
        $content = view('hasil_lab.form', $data)->render();
        $return = [
            'status' => 'success',
            'code' => 200,
            'message' => 'Berhasil',
            'content' => $content
        ];
        return response()->json($return);
    }

    // public function save(Request $request)
    // {
    //     $request->merge([
    //         "no_sediaan" => "1232432424",
    //         "kd_kunjungan_hidden" => null,
    //         "kd_puskesmas_hidden" => null,
    //         "lokasi_anatomi" => "PTB",
    //         "tanggal_daftar" => "2024-08-20",
    //         "pengirim" => "N10000001",
    //         "penerima" => "N10000001",
    //         "pemeriksa" => "N10000001",
    //         "jenis_pemeriksaan" => "mikroskopis",
    //         "tgl_contoh_uji" => "2024-08-20",
    //         "kondisi_contoh_uji_id" => "baik",
    //         "contoh_uji" => "dahak_pagi",
    //         "contoh_uji_lain" => null,
    //         "contoh_uji_hidden" => null,
    //         "no_reg_hasil_mikroskopis" => "3241413",
    //         "tanggal_hasil_mikroskopis" => '2024-08-20',
    //         "hasil_mikroskopis" => '7',
    //         "catatan_mikroskopis" => "kondisi spesimen baik",
    //         "no_reg_hasil_tcm" => null,
    //         "tanggal_hasil_tcm" => null,
    //         "hasil_tcm" => null,
    //         "catatan_tcm" => null,
    //     ]);
    //     // Validasi input
    //     $validatedData = $request->validate([
    //         'lokasi_anatomi' => 'required',
    //         'KD_PELAYANAN' => 'required',
    //         'tanggal_daftar' => 'required|date',
    //         'penerima' => 'required',
    //         'pemeriksa' => 'required', // Validasi tambahan untuk pemeriksa
    //         'contoh_uji' => 'required',
    //         'jenis_pemeriksaan' => 'required',
    //         'tgl_contoh_uji' => 'required|date',
    //     ]);

    //     // Tambahkan kolom lain secara manual jika diperlukan
    //     $validatedData['contoh_uji_lain'] = $request->input('contoh_uji_lain', null);
    //     $validatedData['no_reg_hasil'] = !empty($request->input('no_reg_hasil_mikroskopis')) ? $request->input('no_reg_hasil_mikroskopis') : $request->input('no_reg_hasil_tcm');
    //     $validatedData['tanggal_hasil'] = !empty($request->input('tanggal_hasil_mikroskopis')) ? $request->input('tanggal_hasil_mikroskopis') : $request->input('tanggal_hasil_tcm');
    //     $validatedData['hasil'] = !empty($request->input('hasil_mikroskopis')) ? $request->input('hasil_mikroskopis') : $request->input('hasil_tcm');
    //     $validatedData['catatan'] = !empty($request->input('catatan_mikroskopis')) ? $request->input('catatan_mikroskopis') : $request->input('catatan_tcm');

    //     try {
    //         // Cek apakah terdapat ID, jika ada berarti update, jika tidak berarti create
    //         if ($request->has('id')) {
    //             $hasilLab = HasilLab::query()->findOrFail($request->id);
    //             $hasilLab->update($validatedData);
    //             $message = 'Berhasil mengubah data';
    //         } else {
    //             // Generate UUID untuk create baru

    //             // $response = $this->satuSehatService->createHasilLab($validatedData);


    //             // if (!empty($response['message']['httpCode'])) {

    //             // $validatedData['id'] = Str::uuid();
    //             // $hasilLab = HasilLab::create($validatedData);
    //             // $message = 'Berhasil menyimpan data';
    //             // }else{

    //             $validatedData['id'] = Str::uuid();

    //                 $data = [
    //                     'id' => $validatedData['id'],
                        
    //                 ];

    //                 // Insert the data into the tb_permohonan_lab table
    //               $hasilLab =  DB::table('tb_hasil_lab')->insert($data);
    //               $hasilLab = HasilLab::query()->findOrFail($validatedData['id']);
    //             // $hasilLab = HasilLab::query()->create($validatedData);
    //             $message = 'Berhasil menyimpan data';
    //             // }
    //         }

    //         if (!$hasilLab instanceof HasilLab) {
    //             throw new \Exception('Data untuk permohonan lab belum ada', 404);
    //         }
    //         $mediatorController = new MediatorController();
    //         $mediatorController->hasilLab($request, $hasilLab);

    //         // Mengatur session flash
    //         Session::flash('title', 'Success');
    //         Session::flash('message', $message);
    //         Session::flash('type', 'success');


    //         return response()->json([
    //             'type' => 'success',
    //             'status' => 'success',
    //             'code' => 200,
    //             'alert' => 'alert',
    //             'head_message' => 'Success!',
    //             'message' => $request->has('id') ? 'Berhasil mengubah data' : 'Berhasil menyimpan data',
    //             'data' => $hasilLab
    //         ]);
    //         // return response()->json([
    //         //     'type' => 'error',
    //         //     'status' => 'error',
    //         //     'code' => 200,
    //         //     'alert' => 'alert',
    //         //     'head_message' => 'Gagal!',
    //         //     'message' => $request->has('id') ?  'Gagal mengubah data' : 'Gagal menyimpan data',
    //         //     'data' => $simpan,
    //         // ]);


    //         // }else{

    //         //      // Simpan data
    //         //         $simpan = TbPermohonanLab::create($validatedData);

    //         //         // Mengatur session flash
    //         //         Session::flash('title', 'Success');
    //         //         Session::flash('message', $request->has('id') ? 'Berhasil mengubah data' : 'Berhasil menyimpan data');
    //         //         Session::flash('type', 'success');

    //         //         return response()->json([
    //         //             'type' => 'success',
    //         //             'status' => 'success',
    //         //             'code' => 200,
    //         //             'alert' => 'alert',
    //         //             'head_message' => 'Success!',
    //         //             'message' => $request->has('id') ? 'Berhasil mengubah data' : 'Berhasil menyimpan data',
    //         //             'data' => $simpan,
    //         //         ]);
    //         // }


    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'type' => 'error',
    //             'status' => 'error',
    //             'code' => 250,
    //             'alert' => 'alert',
    //             'head_message' => 'Maaf!',
    //             'message' => $e->getMessage(),
    //             'data' => null,
    //         ]);
    //     }
    // }

    public function save(Request $request)
{
    // Merge default data
    $request->merge([
        "no_sediaan" => "1232432424",
        "kd_kunjungan_hidden" => null,
        "kd_puskesmas_hidden" => null,
        "lokasi_anatomi" => "PTB",
        "tanggal_daftar" => "2024-08-20",
        "pengirim" => "N10000001",
        "penerima" => "N10000001",
        "pemeriksa" => "N10000001",
        "jenis_pemeriksaan" => "mikroskopis",
        "tgl_contoh_uji" => "2024-08-20",
        "kondisi_contoh_uji_id" => "baik",
        "contoh_uji" => "dahak_pagi",
        "contoh_uji_lain" => null,
        "contoh_uji_hidden" => null,
        "no_reg_hasil_mikroskopis" => "3241413",
        "tanggal_hasil_mikroskopis" => '2024-08-20',
        "hasil_mikroskopis" => '7',
        "catatan_mikroskopis" => "kondisi spesimen baik",
        "no_reg_hasil_tcm" => null,
        "tanggal_hasil_tcm" => null,
        "hasil_tcm" => null,
        "catatan_tcm" => null,
    ]);

    // Input validation
    $validatedData = $request->validate([
        // 'lokasi_anatomi' => 'required',
        'KD_PELAYANAN' => 'required',
        'tanggal_daftar' => 'required|date',
        'penerima' => 'required',
        'pemeriksa' => 'required',
        'contoh_uji' => 'required',
        'jenis_pemeriksaan' => 'required',
        'tgl_contoh_uji' => 'required|date',
    ]);

    // Prepare additional fields
    $validatedData['contoh_uji_lain'] = $request->input('contoh_uji_lain', null);
    $validatedData['no_reg_hasil'] = $request->input('no_reg_hasil_mikroskopis') ?? $request->input('no_reg_hasil_tcm');
    $validatedData['tanggal_hasil'] = $request->input('tanggal_hasil_mikroskopis') ?? $request->input('tanggal_hasil_tcm');
    $validatedData['hasil'] = $request->input('hasil_mikroskopis') ?? $request->input('hasil_tcm');
    $validatedData['catatan'] = $request->input('catatan_mikroskopis') ?? $request->input('catatan_tcm');

    try {
        // If 'id' exists, perform update, otherwise create a new record
        if ($request->has('id')) {
            $hasilLab = HasilLab::findOrFail($request->id);
            $hasilLab->update($validatedData);
            $message = 'Berhasil mengubah data';
        } else {
            // Generate UUID for new records
            $validatedData['id'] = Str::uuid();
            
            // Insert new data
            DB::table('tb_hasil_lab')->insert($validatedData);
            $hasilLab = HasilLab::findOrFail($validatedData['id']);
            $message = 'Berhasil menyimpan data';
        }

        if (!$hasilLab instanceof HasilLab) {
            throw new \Exception('Data untuk permohonan lab belum ada', 404);
        }

        // Call mediator controller
        $mediatorController = new MediatorController();
        $mediatorController->hasilLab($request, $hasilLab);

        // Flash session message
        Session::flash('title', 'Success');
        Session::flash('message', $message);
        Session::flash('type', 'success');

        return response()->json([
            'type' => 'success',
            'status' => 'success',
            'code' => 200,
            'alert' => 'alert',
            'head_message' => 'Success!',
            'message' => $message,
            'data' => $hasilLab
        ]);
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
        $hasil_lab = HasilLab::where('id', $request->id)->first();


        $data = [
            'menu' => 'Detail Hasil Lab',
            'hasil_lab' => $hasil_lab
        ];
        $content = view('hasil_lab.detail', $data)->render();
        $return = [
            'status' => 'success',
            'code' => 200,
            'message' => 'Berhasil',
            'content' => $content
        ];
        return response()->json($return);
    }

    public function delete(Request $request)
    {
        $pasien = HasilLab::where('id', $request->id)->first();
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
