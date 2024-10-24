<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Mediator\MediatorController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\TbPermohonanLab;
use App\Models\TbTerduga;

use Illuminate\Support\Facades\Session;

// use Auth, Redirect, Validator, Session, DB, DataTables, URL, File, Excel, DateTime;
use Yajra\DataTables\Facades\DataTables;

class TbPermohonanLabController extends Controller
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

    private $title = "Data Permohonan Lab Pasien";
    private $menuActive = "tb_permohonan_lab";
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

         $data = TbPermohonanLab::orderBy('id', 'DESC')->get();

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
//				'menu'=>'Tambah Data Permohonan Lab',
//				'antrian'=>$antrian,
//				'pasien'=>null,
//                'kd_pasien' => '1'
//			];
//		}else{
//			$permohonan_lab = TbPermohonanLab::where('id',$request->id)->first();
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
//				'menu'=>'Ubah  Data Permohonan Lab',
//				'pasien'=>$permohonan_lab,
//				// 'prov'=>$prov,
//				// 'kab'=>$kab,
//				// 'kec'=>$kec,
//				// 'kel'=>$kel,
//				// 'users'=>1
//			];
//		}
        $patients = TbTerduga::whereNotNull('person_id')->get();

        $data = [
            'data_provinsi' => [],
            'jenis' => isset($request->jenis) ? $request->jenis : '',
            'patients'=>$patients
        ];
        $permohonan_lab = TbPermohonanLab::query()->where('id', $request->id)->first();
        $data1 = [
            'menu' => 'Ubah  Data Permohonan Lab',
            'pasien' => $permohonan_lab,
            // 'prov'=>$prov,
            // 'kab'=>$kab,
            // 'kec'=>$kec,
            // 'kel'=>$kel,
            // 'users'=>1
        ];

        $data = array_merge($data, $data1);
        $content = view('tb_permohonan_lab.form', $data)->render();
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
        // Validasi input
        $validatedData = $request->validate([
            'no_sediaan'=>'required',
            'lokasi_anatomi' => 'required',
            'tanggal_permohonan' => 'required|date',
            'pengirim' => 'required',
            'jenis_pemeriksaan' => 'required',
            'contoh_uji' => 'required',
            'alasan_pemeriksaan' => 'string',
            'tanggal_pengambilan' => 'required|date',
            'tanggal_pengiriman' => 'required|date',
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

                $permohonanLab = TbPermohonanLab::query()->findOrFail($request->id);
                $permohonanLab->update($validatedData);
                $message = 'Berhasil Mengubah data';
                // }

            } else {
               
                $validatedData['id'] = Str::uuid();
                $validatedData['no_sediaan'] = $request->input('no_sediaan');


                    $data = [
                        'id' => $validatedData['id'],
                        'no_sediaan' => $validatedData['no_sediaan'],
                        'lokasi_anatomi' => $validatedData['lokasi_anatomi'],
                        'tanggal_permohonan' => $validatedData['tanggal_permohonan'],
                        'pengirim' => $validatedData['pengirim'],
                        'jenis_pemeriksaan' => $validatedData['jenis_pemeriksaan'],
                        'contoh_uji' => $validatedData['contoh_uji'],
                        'tanggal_pengambilan' => $validatedData['tanggal_pengambilan'],
                        'tanggal_pengiriman' => $validatedData['tanggal_pengiriman'],
                        'created_at' => now(),  // Set timestamps manually if required
                        'updated_at' => now()
                    ];

                    // Insert the data into the tb_permohonan_lab table
                  $permohonanLab =  DB::table('tb_permohonan_lab')->insert($data);
                  $permohonanLab = TbPermohonanLab::query()->findOrFail($validatedData['id']);
                  // Log to confirm what is being saved
            \Log::info('Permohonan Lab created', ['data' => $permohonanLab]);
            // die;
                // echo '<pre>';
                // var_dump($validatedData);die;
                $message = 'Berhasil menyimpan data';

                // }
            }

            if (!$permohonanLab instanceof TbPermohonanLab) {
                // echo '<pre>';
                // var_dump($permohonanLab);die;
                throw new \Exception('Data untuk permohonan lab belum ada', 404);
            }
            $mediatorController = new MediatorController();

            $mediatorController->permohonanLab($request, $permohonanLab);

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
        $permohonan_lab = TbPermohonanLab::where('id', $request->id)->first();


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

        $permohonan_lab = TbPermohonanLab::where('id', $request->id)->first();

        $return = ['status' => 'success', 'code' => 200, 'data' => $permohonan_lab];
        return response()->json($return);
    }

    public function delete(Request $request)
    {
        $pasien = TbPermohonanLab::where('id', $request->id)->first();
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
