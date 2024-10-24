<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Mediator\SatuSehat\Lib\Client\ApiException;
use Mediator\SatuSehat\Lib\Client\Model\Condition;
use Mediator\SatuSehat\Lib\Client\Model\Encounter;
use Mediator\SatuSehat\Lib\Client\Model\ModelInterface;
use Mediator\SatuSehat\Lib\Client\Model\Patient;
use Mediator\SatuSehat\Lib\Client\Model\SubmitResponse;
use Mediator\SatuSehat\Lib\Client\Model\TbSuspect;
use Mediator\SatuSehat\Lib\Client\Profiles\ValidationException;

class MediatorService extends BaseService
{

    public function __construct(string $formClass, string $organizationId, string $locationId, string $practionerNik, string $kunjungan, TbSuspect $tbSuspect, Patient $patient)
    {
        parent::__construct($formClass, $organizationId, $locationId, $practionerNik, $kunjungan, $tbSuspect, $patient);
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function initData()
    {
        // kirim dari luar
        $this->form->setProfile(['TB']);// TODO: cannot be hardcoded
        $this->form->setOrganizationId($this->organizationId); // TODO: cannot be hardcoded s
        $this->form->setLocationId($this->locationId); // TODO: cannot be hardcoded s
        $this->form->setPractitionerNik($this->practionerNik); // TODO: cannot be hardcoded s


// $patient->setAddress([new AddressPatient( // required in terduga tb
//     [
//         "use" => "temp", // temp = alamat domisili, home = alamat ktp
//         // "country" => "id",
//         "province" => "35", // kode depdagri 2 digit untuk provinsi
//         "city" => "3578", // kode depdagri 4 digit untuk kab/kota
//         "district" => "357801", // kode depdagri 6 digit untuk kecamatan
//         "village" => "3578011002", // kode depdagri 10 digit untuk kelurahan/desa
//         "rt" => "",
//         "rw" => "",
//         "postal_code" => "-",
//         "line" => ["alamat jalan dan informasi lainnya"]
//     ]
// )]);

        $this->form->setPatient($this->patient);


        $this->form->setTbSuspect($this->tbSuspect);
//        $this->form->setEncounter([
//            "encounter_id" => "83ef7e32-64f3-40a7-87c4-3cc59d44b4c6",
//            "local_id" => "2024-05-24 09:27:26.405593+07",
//            "classification" => "AMB",
//            "period_start" => "2024-05-24T09:28:01+07:00",
//            "period_in_progress" => "2024-05-24T09:58:01+07:00",
//            "period_end" => "2024-05-24T10:58:01+07:00"
//        ]);

        // TODO: encounter still hardcoded
        $encounter = new Encounter();
        $encounter
            ->setLocalId($this->kunjungan)
            ->setClassification('AMB')
            ->setPeriodStart(parseDateTimeWithTimezone(date('Y-m-d')))
            ->setPerionInProgress(parseDateTimeWithTimezone(date('Y-m-d')))
            ->setPeriodEnd(parseDateTimeWithTimezone(date('Y-m-d')));
        $this->form->setEncounter($encounter);
        $this->form->addCondition(
            (new Condition())
                ->setCodeCondition("Z10")
        );
    }

    // kirim dari luar

    /**
     * @param array $input
     * @return array|false|ModelInterface|SubmitResponse|string
     * @throws GuzzleException
     * @throws ApiException
     */

   public function sendTerdugaTb(array $input)
    {
        $this->initData();
        $this->form->build();

        // dump($this->form->getBody());

        try {
            $response = $this->form->send();
        } catch (RequestException $e) {
            // echo ' ABCDEF ' . json_encode($e->getResponseBody());
            $response = json_encode(json_decode($e->getResponse()->getBody()->getContents()), JSON_PRETTY_PRINT);
        }

         // dump($response);


        return $response;
    }
    public function sendPermohonanLab(array $input)
    {
        $this->initData();
        $this->form->setTanggalPermohonan($input['tanggal_permohonan'])
            ->setDokterPengirim('N10000001')
            ->setFaskesTunjuan('100011961')
            ->setJenisPemeriksaan($input['jenis_pemeriksaan'])
            ->setJenisContohUji($input['contoh_uji'])
            ->setTanggalWaktuPengambilanContohUji($input['tanggal_pengambilan'])
            ->setTanggalWaktuPengirimanContohUji($input['tanggal_pengiriman']);
        $this->form->setAlasanPemeriksaan($input['alasan_pemeriksaan'] ?? 'pemeriksaan_diagnosis');
        if (!empty($input['lokasi_anatomi']))
            $this->form->setDugaanLokasiAnatomi($input['lokasi_anatomi']);

        $this->form->build();

         // dump($this->form->getBody());

        try {
            $response = $this->form->send();
        } catch (RequestException $e) {
            // echo ' ABCDEF ' . json_encode($e->getResponseBody());
            $response = json_encode(json_decode($e->getResponse()->getBody()->getContents()), JSON_PRETTY_PRINT);
        }

         // dump($response);

        return $response;
    }

    /**
     * @param array $input
     * @param array|null $hasilUji
     * @param string|null $serviceRequestId
     * @param string|null $noRegLab
     * @return array|false|ModelInterface|SubmitResponse|string
     * @throws ApiException
     * @throws GuzzleException
     */
    public function sendHasilLab(
        array  $input,
        ?array $hasilUji = null,
        string $serviceRequestId = null,
        string $noRegLab = null
    )
    {
        $this->initData();

        $specimentId = 'e0768d3a-57e3-42c0-9c06-61ccd584cc6a';

        $tanggalHasil = parseDateTime(!empty($input['tanggal_hasil_mikroskopis']) ? parseDateTime($input['tanggal_hasil_mikroskopis']) : parseDateTime($input['tanggal_hasil_tcm']));

        $catatan = !empty($input['catatan_mikroskopis']) ? $input['catatan_mikroskopis'] : $input['catatan_tcm'];
        $nilai = !empty($input['hasil_mikroskopis']) ? $input['hasil_mikroskopis'] : $input['hasil_tcm'];

        $hasil = $this->form;
        /** dokter pengirim, penerima, pemeriksa */
        $hasil
            // ->setDokterPengirim($input['pengirim'])
            ->setPenerimaContohUji($input['penerima'])
            ->setDokterPemeriksaLab($input['pemeriksa']);

        /** dokter pengirim, penerima, pemeriksa */
        $hasil
            ->setJenisPemeriksaan($input['jenis_pemeriksaan']);
        /** tanggal */
        $hasil
            ->setTanggalWaktuPenerimaanContohUji(parseDateTime($input['tgl_contoh_uji']))
            ->setTanggalWaktuRegisterLab(parseDateTime($input['tanggal_daftar']));

        /** hardcoded */

        $hasil = $this->form
            // ->setPermohonanLabId($permohonanId)
            ->setFasyankesTujuan('100011961')
            ->setJenisContohUji($input['contoh_uji'])
            ->setSpesimenId($specimentId, 'specimen_1')
//            ->setPermohonanLabId($serviceRequestId)
            ->setServiceRequestId($serviceRequestId)
            ->setKonfirmasiContohUji($input['kondisi_contoh_uji_id'], null)
            ->getHasil();

        $hasil->setContohUji($input['contoh_uji'])
            ->setTanggalHasil($tanggalHasil)
            ->setNomorRegistrasiLab($noRegLab)
            ->setCatatan($catatan)
            ->setNilai($nilai);

        if (!empty($hasilUji)) {
            if ($input['jenis_pemeriksaan'] == 'tcm_xdr') {
                $hasil->setMtb($hasilUji['mtb'])
                    ->setHDosisRendah($hasilUji['h'])
                    ->setH($hasilUji['ht'])
                    ->setFq($hasilUji['fq'])
                    ->setFqt($hasilUji['fqt'])
                    ->setAmk($hasilUji['amk'])
                    ->setKm($hasilUji['km'])
                    ->setCm($hasilUji['cm'])
                    ->setEto($hasilUji['eto']);
            } elseif ($input['jenis_pemeriksaan'] == 'lini_1') {
                $hasil->setMtb($hasilUji['mtb'])
                    ->setHDosisRendah($hasilUji['h'])
                    ->setH($hasilUji['ht'])
                    ->setRifampisin($hasilUji['rif'])
                    ->setEto($hasilUji['eto'])
                    ->setPto($hasilUji['pto']);
            } elseif ($input['jenis_pemeriksaan'] == 'lini_2') {

            } elseif ($input['jenis_pemeriksaan'] == 'biakan') {

            } elseif ($input['jenis_pemeriksaan'] == 'kepekaan') {

            } elseif ($input['jenis_pemeriksaan'] == 'bdmax') {

            } elseif ($input['jenis_pemeriksaan'] == 'pcr') {

            }
        }


        $this->form->build();

//        $this->form->validate();
         // dump($this->form->getBody());


        try {
            $response = $this->form->send();
        } catch (RequestException $e) {
            // echo ' ABCDEF ' . json_encode($e->getResponseBody());
            $response = json_encode(json_decode($e->getResponse()->getBody()->getContents()), JSON_PRETTY_PRINT);
        }

         // dump($response);

        return $response;
    }

    /**
     * @param array $input
     * @return array|false|ModelInterface|SubmitResponse|string
     * @throws ApiException
     * @throws GuzzleException
     * @throws ValidationException
     */
    public function sendHasilDiagnosa(array $input)
    {
        $this->initData();

        $this->form
            ->setStatusPengobatan('not-started')
            // ->setPermohonanLabId($permohonanId)
            ->setTanggalHasilDiagnosis($input['tanggal_hasil'])
            ->setXrayHasil($input['hasil_pemeriksaan'])
            ->setXrayTanggalWaktu($input['thorax_tanggal'])
            ->setXrayKesan($input['thorax_kesan'])
            ->setLokasiAnatomi($input['lokasi_anatomi'])
            ->setHasilDiagnosis('active', '2')
            ->setTipeDiagnosis($input['tipe_diagnosis'])
            ->setTindakLanjutPengobatan($input['tindak_lanjut'])
            ->setTempatPengobatan($input['tempat_pengobatan'])
            ->build();

        dump($this->form->getBody());

//        $this->form->validate();

        try {
            $response = $this->form->send();
        } catch (RequestException $e) {
            // echo ' ABCDEF ' . json_encode($e->getResponseBody());
            $response = json_encode(json_decode($e->getResponse()->getBody()->getContents()), JSON_PRETTY_PRINT);
        }
        dd($response);
        return $response;
    }

}