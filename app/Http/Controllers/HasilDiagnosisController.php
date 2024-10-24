<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Mediator\MediatorController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

// use App\Services\SatuSehatService;

use App\Models\HasilDiagnosis;
// use Auth, Redirect, Validator, Session, DB, DataTables, URL, File, Excel, DateTime;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class HasilDiagnosisController extends Controller
{

    // protected $satuSehatService;

    // public function __construct(SatuSehatService $satuSehatService)
    // {
    //     $this->satuSehatService = $satuSehatService;
    // }


    private $title = "Data Hasil Diagnosis Pasien";
    private $menuActive = "hasil_diagnosis";
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
        $data = HasilDiagnosis::orderBy('id', 'DESC');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('aksi', function ($row) {

                // echo '<pre>';
                // var_dump($row);die;
                $aksi = '<a href="javascript:void(0)" onclick="detailForm(\'' . $row->id . '\')" class="btn btn-warning btn-sm text-white mr-1"><i class="fa fa-eye"></i></a>' .
                    '<a href="javascript:void(0)" onclick="editForm(\'' . $row->id . '\')" class="btn btn-primary btn-sm mr-1"><i class="fa fa-edit"></i></a>';
                // '<a href="javascript:void(0)" onclick="deleteForm(\''.$row->id.'\')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';


                return $aksi;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }


    public function form(Request $request)
    {
//        $data_provinsi = Provinsi::all();
//        $data = [
//            'data_provinsi' => $data_provinsi,
//            'jenis'=> isset($request->jenis) ? $request->jenis : '',
//        ];
//        if (empty($request->id)) {
//            if(isset($request->id_antrian)){
//                $antrian = Antrian::find($request->id_antrian);
//            }else{
//                $antrian = '';
//            }
//
//            $data1 = [
//                'menu'=>'Tambah Data Hasil Diagnosis',
//                'antrian'=>$antrian,
//                'users'=>'',
//                'kd_pasien' => '1'
//            ];
//        }else{
//            $hasil_lab = HasilDiagnosis::where('id',$request->id)->first();
//            // $namaProv = !empty(Provinsi::where('KD_PROVINSI', $pasien->provinsi_id)->first()) ? Provinsi::where('KD_PROVINSI', $pasien->provinsi_id)->first()->PROVINSI : "";
//            // $namaKab = !empty(Kabupaten::where('KD_KABUPATEN', $pasien->kabupaten_id)->first()) ? Kabupaten::where('KD_KABUPATEN', $pasien->kabupaten_id)->first()->KD_KABUPATEN : "";
//            // $namaKec = !empty(Kecamatan::where('KD_KECAMATAN', $pasien->kecamatan_id)->first()) ? Kecamatan::where('KD_KECAMATAN', $pasien->kecamatan_id)->first()->KD_KECAMATAN : "";
//            // $namaKel = !empty(Desa::where('KD_KELURAHAN', $pasien->desa_id)->first()) ? Desa::where('KD_KELURAHAN', $pasien->desa_id)->first()->KD_KELURAHAN : "";
//            // $prov = $namaProv;
//            // $kab = $namaKab;
//            // $kec = $namaKec;
//            // $kel = $namaKel;
//
//            $data1 = [
//                'menu'=>'Ubah  Data Hasil Diagnosis',
//                'pasien'=>$hasil_lab,
//                // 'prov'=>$prov,
//                // 'kab'=>$kab,
//                // 'kec'=>$kec,
//                // 'kel'=>$kel,
//                // 'users'=>1
//            ];
//        }
        $hasil_lab = HasilDiagnosis::where('id', $request->id)->first();

        $data = [
            'data_provinsi' => [],
            'jenis' => isset($request->jenis) ? $request->jenis : '',
        ];
        $data1 = [
            'menu' => 'Ubah  Data Hasil Diagnosis',
            'pasien' => $hasil_lab,
            // 'prov'=>$prov,
            // 'kab'=>$kab,
            // 'kec'=>$kec,
            // 'kel'=>$kel,
            // 'users'=>1
        ];
        $data = array_merge($data, $data1);
        $content = view('hasil_diagnosis.form', $data)->render();
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
            'tanggal_hasil' => 'required|date',
            'lokasi_anatomi' => 'required',
            'hasil_pemeriksaan' => 'required',
            'thorax_tanggal' => 'nullable|date',
            'thorax_kesan' => 'nullable|string',
            'hasil_diagnosis' => 'required',
            'tipe_diagnosis' => 'required',
            'tindak_lanjut' => 'required',
            'tempat_pengobatan' => 'required',
        ]);

        try {
            // Cek apakah terdapat ID, jika ada berarti update, jika tidak berarti create
            if ($request->has('id')) {
                $hasilDiagnosis = HasilDiagnosis::findOrFail($request->id);
                $hasilDiagnosis->update($validatedData);
                $message = 'Berhasil mengubah data';
            } else {
                // Generate UUID untuk create baru
                $validatedData['id'] = Str::uuid();
                $hasilDiagnosis = HasilDiagnosis::create($validatedData);
                $message = 'Berhasil menyimpan data';
            }

            $mediatorController = new MediatorController();
            $mediatorController->hasilDiagnosis($request, $hasilDiagnosis);


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
                'message' => $message,
                'data' => $hasilDiagnosis,
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
        $hasil_lab = HasilDiagnosis::where('id', $request->id)->first();


        $data = [
            'menu' => 'Detail Hasil Diagnosis',
            'hasil_lab' => $hasil_lab
        ];
        $content = view('hasil_diagnosis.detail', $data)->render();
        $return = [
            'status' => 'success',
            'code' => 200,
            'message' => 'Berhasil',
            'content' => $content
        ];
        return response()->json($return);
    }


}
